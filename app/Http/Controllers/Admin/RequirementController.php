<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requirement;

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
}

