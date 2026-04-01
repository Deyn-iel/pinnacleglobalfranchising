<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requirement;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

class RequirementController extends Controller
{
public function index()
{
    $folders = collect(Storage::disk('public')->directories('requirements'))
        ->map(function ($path) {
            return basename($path);
        });

    return view('admin.requirements', compact('folders'));
}

public function store(Request $request)
{
    $request->validate([
        'folder' => 'required|string|max:255'
    ]);

    $folder = str_replace(' ', '_', $request->folder);

    Storage::disk('public')->makeDirectory("requirements/$folder");

    return back()->with('success', 'Folder created successfully!');
}
public function destroy($id)
{
    $requirement = Requirement::findOrFail($id);

    // delete file from storage
    if ($requirement->file_path && Storage::disk('public')->exists($requirement->file_path)) {
        Storage::disk('public')->delete($requirement->file_path);
    }

    // delete database record
    $requirement->delete();

    return response()->json([
        'success' => true,
        'message' => 'File deleted successfully!'
    ]);
}

public function uploadToFolder(Request $request, $folder)
{
    $request->validate([
        'file' => 'required|file|max:51200',
    ]);

    $file = $request->file('file');

    // SAVE FILE SA FOLDER (no category)
    $path = $file->store("requirements/$folder", 'public');

    $requirement = Requirement::create([
        'document_name'      => $file->getClientOriginalName(),
        'file_path'          => $path,
        'file_original_name' => $file->getClientOriginalName(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'File uploaded successfully!',
        'file' => [
            'id' => $requirement->id,
            'original_name' => $requirement->file_original_name,
            'file_path' => $requirement->file_path,
        ]
    ]);
}

public function viewFolder($folder)
{
    $files = Requirement::where('file_path', 'like', "requirements/$folder/%")
        ->latest()
        ->get();

    return view('admin.folder-files', compact('files', 'folder'));
}
public function deleteFolder($folder)
{
    $folderPath = 'requirements/' . $folder;

    if (Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->deleteDirectory($folderPath);
    }

    return redirect()->back()->with('success', 'Folder deleted successfully.');
}
}

