<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\User;
use App\Mail\PayslipMail;
use Illuminate\Support\Facades\Mail;

use ZipArchive;

class PayslipController extends Controller
{
    public function index(Request $request)
{
    $q = $request->query('q');

    $foldersQuery = Payslip::query()
        ->selectRaw('folder_key, year, month, COUNT(*) as count, MAX(created_at) as latest')
        ->groupBy('folder_key', 'year', 'month')
        ->orderByDesc('folder_key');

    if ($q) {
        $foldersQuery->where('folder_key', 'like', "%{$q}%");
    }

    $folders = $foldersQuery->get()->map(function ($f) {

    $files = Payslip::where('folder_key', $f->folder_key)
    ->with('uploader')
    ->latest()
    ->take(10)
    ->get();

    $label = \Carbon\Carbon::create($f->year, $f->month, 1)->format('M Y');

    return [
        'key' => $f->folder_key,
        'label' => $label,
        'count' => (int)$f->count,
        'latest' => \Carbon\Carbon::parse($f->latest)->format('M d, Y'),
        'files' => $files,
    ];
});

    $recentPayslips = Payslip::query()
    ->with('uploader')
    ->latest()
    ->take(10)
    ->get();

// ⭐ ito ang missing
$payslips = Payslip::with('uploader')
    ->latest()
    ->paginate(10);

$payslipsCount = Payslip::count();

return view(
    'admin.headoffice-portals.hr.payslip',
    compact('folders', 'recentPayslips', 'payslipsCount', 'payslips', 'q')
);
}

    public function store(Request $request)
    {
        $request->validate([
    'month' => ['required', 'integer', 'min:1', 'max:12'],
    'year'  => ['required', 'integer', 'min:2000', 'max:' . now()->year],
    'cutoff' => ['required', 'in:1,2'], 
    'batch_name' => ['nullable', 'string', 'max:120'],

    'files' => ['required', 'array', 'min:1'],
    'files.*' => ['file', 'max:10240', 'mimes:pdf,doc,docx,jpg,jpeg,png,zip'],
]);

        $month = (int)$request->month;
        $year  = (int)$request->year;
        $cutoff = $request->cutoff;

// cutoff label
if ($cutoff == 1) {
    $folderKey = sprintf('%04d-%02d-10_25', $year, $month);
} else {
    // next month handling
    $nextMonth = $month == 12 ? 1 : $month + 1;
    $nextYear = $month == 12 ? $year + 1 : $year;

    $folderKey = sprintf('%04d-%02d-26_%04d-%02d-10',
        $year, $month,
        $nextYear, $nextMonth
    );
}

        $baseDir = "payslips/{$year}/" . str_pad((string)$month, 2, '0', STR_PAD_LEFT);

        $saved = 0;
        $skipped = 0;
        $skippedFiles = [];

        foreach ($request->file('files') as $file) {

    if (strtolower($file->getClientOriginalExtension()) === 'zip') {

        $zip = new ZipArchive();

        if ($zip->open($file->getRealPath()) !== true) {
            $skipped++;
            $skippedFiles[] = $file->getClientOriginalName() . " (zip open failed)";
            continue;
        }

        // temp extraction folder
        $extractTo = storage_path('app/tmp/payslip_zip_' . Str::random(10));
        if (!is_dir($extractTo)) {
            File::makeDirectory($extractTo, 0755, true);
        }

        $zip->extractTo($extractTo);
        $zip->close();

        // scan extracted files
        $all = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($extractTo, \FilesystemIterator::SKIP_DOTS)
            );

        foreach ($all as $f) {
            if ($f->isDir()) continue;

            $fullPath = $f->getPathname();
            $originalName = $f->getFilename();

            $real = realpath($fullPath);
            $base = realpath($extractTo);

            if (!$real || !$base || !str_starts_with($real, $base)) {
                $skipped++;
                $skippedFiles[] = $originalName . " (invalid path)";
                continue;
            }

            $allowed = ['pdf','doc','docx','jpg','jpeg','png'];
            $ext2 = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            if (!in_array($ext2, $allowed, true)) {
                $skipped++;
                $skippedFiles[] = $originalName . " (invalid type)";
                continue;
            }

            // skip junk/mac files
            if (str_contains($real, DIRECTORY_SEPARATOR . '__MACOSX' . DIRECTORY_SEPARATOR) || str_starts_with($originalName, '.')) {
                continue;
            }

            // filename must be email (without extension)
            $emailFromFile = trim(strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
            $user = User::whereRaw('LOWER(email) = ?', [$emailFromFile])->first();

            if (!$user) {
                $skipped++;
                $skippedFiles[] = $originalName . " (parsed: {$emailFromFile})";
                continue;
            }

            // save extracted file to storage/public
            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
            $storedName = now()->format('YmdHis') . '_' . Str::random(10) . ($ext ? ".{$ext}" : '');

            // put file into your public disk folder
            $destinationPath = $baseDir . '/' . $storedName;
            Storage::disk('public')->put($destinationPath, file_get_contents($real));

            $mime = mime_content_type($real) ?: null;
            $size = filesize($real) ?: 0;

            $payslip = Payslip::create([
                'folder_key' => $folderKey,
                'year' => $year,
                'month' => $month,
                'batch_name' => $request->batch_name,
                'original_name' => $originalName,
                'stored_name' => $storedName,
                'file_path' => $destinationPath,
                'file_size' => (int)$size,
                'mime_type' => $mime,
                'uploaded_by' => Auth::id(),
            ]);

            try {
    Mail::to($user->email)->send(new PayslipMail($payslip));
    $saved++;
} catch (\Throwable $e) {
    $skipped++;
    $skippedFiles[] = $originalName . " (email failed: " . $e->getMessage() . ")";
}
        }

        // cleanup extracted temp folder
        try {
            File::deleteDirectory($extractTo);
        } catch (\Throwable $e) {
            // ignore cleanup errors
        }

        continue; // done processing this zip
    }

    $originalName = $file->getClientOriginalName();
    $mime = $file->getClientMimeType();
    $size = $file->getSize();

    $emailFromFile = trim(strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
    $user = User::whereRaw('LOWER(email) = ?', [$emailFromFile])->first();

    if (!$user) {
        $skipped++;
        $skippedFiles[] = $originalName . " (parsed: {$emailFromFile})";
        continue;
    }

    $ext = $file->getClientOriginalExtension();
    $storedName = now()->format('YmdHis') . '_' . Str::random(10) . ($ext ? ".{$ext}" : '');
    $path = $file->storeAs($baseDir, $storedName, 'public');

    $payslip = Payslip::create([
        'folder_key' => $folderKey,
        'year' => $year,
        'month' => $month,
        'batch_name' => $request->batch_name,
        'original_name' => $originalName,
        'stored_name' => $storedName,
        'file_path' => $path,
        'file_size' => (int)$size,
        'mime_type' => $mime,
        'uploaded_by' => Auth::id(),
    ]);

    try {
    Mail::to($user->email)->send(new PayslipMail($payslip));
    $saved++;
} catch (\Throwable $e) {
    $skipped++;
    $skippedFiles[] = $originalName . " (email failed: " . $e->getMessage() . ")";
}
}

return back()->with('success', "Uploaded: {$saved} | Skipped: {$skipped}")
            ->with('skipped_files', $skippedFiles);
    }

    public function download(Payslip $payslip)
    {
        if (!Storage::disk('public')->exists($payslip->file_path)) {
            return back()->with('success', 'File not found in storage.');
        }

        $downloadName = $payslip->original_name ?: $payslip->stored_name;

        return response()->download(Storage::disk('public')->path($payslip->file_path), $downloadName);
    }

    public function destroy(Payslip $payslip)
    {
        if (Storage::disk('public')->exists($payslip->file_path)) {
            Storage::disk('public')->delete($payslip->file_path);
        }

        $payslip->delete();

        return back()->with('success', 'Payslip deleted successfully.');
    }
}
