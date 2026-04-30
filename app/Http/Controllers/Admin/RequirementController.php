<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requirement;
use Illuminate\Support\Facades\Storage;

class RequirementController extends Controller
{
    private function cleanFolderName($name)
    {
        $name = trim((string) $name);
        $name = str_replace(' ', '_', $name);
        $name = preg_replace('/[^A-Za-z0-9_\-]/', '', $name);

        return $name ?: 'Untitled_Folder';
    }

    private function normalizePath($path)
    {
        $path = trim((string) $path, '/');
        $path = str_replace('\\', '/', $path);

        $parts = array_filter(explode('/', $path), function ($part) {
            return trim($part) !== '';
        });

        $parts = array_map(function ($part) {
            return $this->cleanFolderName($part);
        }, $parts);

        return implode('/', $parts);
    }

    private function allowedDepartments()
    {
        return [
            'it',
            'hr',
            'smm',
            'od',
            'om',
            'admin-secretary',
        ];
    }

    private function departmentView($department)
    {
        if (!in_array($department, $this->allowedDepartments(), true)) {
            abort(404);
        }

        return "admin.headoffice-portals.{$department}.company-files";
    }

    public function index()
    {
        $basePath = 'requirements';

        if (!Storage::disk('public')->exists($basePath)) {
            Storage::disk('public')->makeDirectory($basePath);
        }

        $folders = collect(Storage::disk('public')->directories($basePath))
            ->map(fn ($path) => basename($path))
            ->values();

        return view('admin.requirements', compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'folder' => 'required|string|max:255',
        ]);

        $folder = $this->cleanFolderName($request->folder);
        $folderPath = "requirements/{$folder}";

        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        return back()->with('success', 'Folder created successfully!');
    }

    public function storeInsideFolder(Request $request, $folder)
    {
        $request->validate([
            'folder' => 'required|string|max:255',
        ]);

        $parentFolder = $this->normalizePath($folder);
        $newFolder = $this->cleanFolderName($request->folder);

        $folderPath = "requirements/{$parentFolder}/{$newFolder}";

        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        return back()->with('success', 'Subfolder created successfully!');
    }

    public function viewFolder($folder)
    {
        $folder = $this->normalizePath($folder);
        $folderPath = "requirements/{$folder}";

        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        $subfolders = collect(Storage::disk('public')->directories($folderPath))
            ->map(function ($path) {
                return [
                    'name' => basename($path),
                    'path' => str_replace('requirements/', '', $path),
                ];
            })
            ->values();

        $files = Requirement::where('file_path', 'like', "{$folderPath}/%")
            ->latest()
            ->get()
            ->filter(function ($file) use ($folderPath) {
                $relative = str_replace($folderPath . '/', '', $file->file_path);

                return !str_contains($relative, '/');
            })
            ->values();

        $folderName = basename($folder);

        $parentFolder = str_contains($folder, '/')
            ? dirname($folder)
            : null;

        return view('admin.folder-files', compact(
            'files',
            'folder',
            'folderName',
            'parentFolder',
            'subfolders'
        ));
    }

    public function uploadToFolder(Request $request, $folder)
    {
        $request->validate([
            'file' => 'required|file|max:51200',
        ]);

        $folder = $this->normalizePath($folder);
        $folderPath = "requirements/{$folder}";

        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        $file = $request->file('file');
        $path = $file->store($folderPath, 'public');

        $requirement = Requirement::create([
            'document_name'      => $file->getClientOriginalName(),
            'file_path'          => $path,
            'file_original_name' => $file->getClientOriginalName(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully!',
                'file' => [
                    'id' => $requirement->id,
                    'original_name' => $requirement->file_original_name,
                    'file_path' => $requirement->file_path,
                ],
            ]);
        }

        return back()->with('success', 'File uploaded successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $requirement = Requirement::findOrFail($id);

        if ($requirement->file_path && Storage::disk('public')->exists($requirement->file_path)) {
            Storage::disk('public')->delete($requirement->file_path);
        }

        $requirement->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully!',
            ]);
        }

        return back()->with('success', 'File deleted successfully!');
    }

    public function download(string $department, Requirement $requirement)
{
    if (! Storage::disk('public')->exists($requirement->file_path)) {
        abort(404, 'File not found.');
    }

    return response()->download(
        Storage::disk('public')->path($requirement->file_path),
        $requirement->file_original_name ?? $requirement->document_name
    );
}

    public function deleteFolder($folder)
    {
        $folder = $this->normalizePath($folder);
        $folderPath = "requirements/{$folder}";

        $files = Requirement::where('file_path', 'like', "{$folderPath}/%")->get();

        foreach ($files as $file) {
            if ($file->file_path && Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }

            $file->delete();
        }

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $parentFolder = str_contains($folder, '/')
            ? dirname($folder)
            : null;

        if ($parentFolder) {
            return redirect()
                ->route('admin.folder.view', $parentFolder)
                ->with('success', 'Folder deleted successfully.');
        }

        return redirect()
            ->route('admin.requirements')
            ->with('success', 'Folder deleted successfully.');
    }

    public function portalIndex($department)
    {
        if (!in_array($department, $this->allowedDepartments(), true)) {
            abort(404);
        }

        $basePath = 'requirements';

        if (!Storage::disk('public')->exists($basePath)) {
            Storage::disk('public')->makeDirectory($basePath);
        }

        $folders = collect(Storage::disk('public')->directories($basePath))
            ->map(fn ($path) => basename($path))
            ->values();

        return view($this->departmentView($department), compact(
            'folders',
            'department'
        ));
    }

    public function portalFolder($department, $folder)
    {
        if (!in_array($department, $this->allowedDepartments(), true)) {
            abort(404);
        }

        $folder = $this->normalizePath($folder);
        $folderPath = "requirements/{$folder}";

        if (!Storage::disk('public')->exists($folderPath)) {
            return redirect()->route('portal.company-files', $department);
        }

        $subfolders = collect(Storage::disk('public')->directories($folderPath))
            ->map(function ($path) {
                return [
                    'name' => basename($path),
                    'path' => str_replace('requirements/', '', $path),
                ];
            })
            ->values();

        $files = Requirement::where('file_path', 'like', "{$folderPath}/%")
            ->latest()
            ->get()
            ->filter(function ($file) use ($folderPath) {
                $relative = str_replace($folderPath . '/', '', $file->file_path);

                return !str_contains($relative, '/');
            })
            ->values();

        $folderName = basename($folder);

        $parentFolder = str_contains($folder, '/')
            ? dirname($folder)
            : null;

        return view($this->departmentView($department), compact(
            'files',
            'folder',
            'folderName',
            'parentFolder',
            'subfolders',
            'department'
        ));
    }
}
