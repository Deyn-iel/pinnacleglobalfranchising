<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requirement;
use Illuminate\Support\Facades\Storage;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::latest()->get();
        return view('admin.requirements', compact('requirements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'category'      => 'required|string',
            'file'          => 'required|file|mimes:pdf,jpg,jpeg,png,docx,zip|max:10240',
        ]);

        // Store file
        $file = $request->file('file');
        $path = $file->store('requirements', 'public');

        // Save to DB
        Requirement::create([
            'document_name'      => $request->document_name,
            'category'           => $request->category,
            'file_path'          => $path,
            'file_original_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
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

    return redirect()->back()->with('success', 'Requirement deleted successfully.');
}
}

