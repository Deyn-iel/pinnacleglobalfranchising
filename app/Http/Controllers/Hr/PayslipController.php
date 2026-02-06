<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $label = \Carbon\Carbon::create($f->year, $f->month, 1)->format('M Y');
        return [
            'key' => $f->folder_key,
            'label' => $label,
            'count' => (int)$f->count,
            'latest' => \Carbon\Carbon::parse($f->latest)->format('M d, Y'),
        ];
    });

    $recentPayslips = Payslip::query()
        ->with('uploader')
        ->latest()
        ->take(10)
        ->get();

    // optional stats
    $payslipsCount = Payslip::count();

    return view('admin.hr.dashboard', compact('folders', 'recentPayslips', 'payslipsCount', 'q'));
}

    public function store(Request $request)
    {
        $request->validate([
            'month' => ['required', 'integer', 'min:1', 'max:12'],
            'year'  => ['required', 'integer', 'min:2000', 'max:' . now()->year],
            'batch_name' => ['nullable', 'string', 'max:120'],

            'files' => ['required', 'array', 'min:1'],
            'files.*' => ['file', 'max:10240'], // 10MB each (adjust if needed)
        ]);

        $month = (int)$request->month;
        $year  = (int)$request->year;
        $folderKey = sprintf('%04d-%02d', $year, $month);

        $baseDir = "payslips/{$year}/" . str_pad((string)$month, 2, '0', STR_PAD_LEFT);

        $saved = 0;

        foreach ($request->file('files') as $file) {
            $originalName = $file->getClientOriginalName();
            $mime = $file->getClientMimeType();
            $size = $file->getSize();

            // safe unique filename
            $ext = $file->getClientOriginalExtension();
            $storedName = now()->format('YmdHis') . '_' . Str::random(10) . ($ext ? ".{$ext}" : '');

            $path = $file->storeAs($baseDir, $storedName, 'public');

            Payslip::create([
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

            $saved++;
        }

        return back()->with('success', "{$saved} file(s) uploaded to {$folderKey}.");
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
