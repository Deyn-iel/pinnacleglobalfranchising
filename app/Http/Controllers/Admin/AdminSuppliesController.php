<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSuppliesController extends Controller
{
    public function index()
    {
        $supplies = Supply::latest()->get();
        return view('admin.supplies', compact('supplies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'unit'          => 'required|string|max:50',
            'cost_price'    => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'image'         => 'nullable|image|max:2048',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('supplies', 'public');
        }

        Supply::create([
            'name'          => $request->name,
            'unit'          => $request->unit,
            'cost_price'    => $request->cost_price,
            'selling_price' => $request->selling_price,
            'stock'         => $request->stock,
            'image'         => $image,
        ]);

        return back()->with('success', 'Supply added successfully.');
    }

    // ✏️ EDIT
    public function edit(Supply $supply)
    {
        return view('admin.supplies-edit', compact('supply'));
    }

    // 🔄 UPDATE
    public function update(Request $request, Supply $supply)
    {
        $request->validate([
            'name'          => 'required',
            'unit'          => 'required',
            'cost_price'    => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock'         => 'required|integer|min:0',
            'image'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($supply->image) {
                Storage::disk('public')->delete($supply->image);
            }
            $supply->image = $request->file('image')->store('supplies', 'public');
        }

        $supply->update($request->only([
            'name','unit','cost_price','selling_price','stock'
        ]));

        return redirect()->route('admin.supplies')
            ->with('success', 'Supply updated successfully.');
    }

    // 🗑 DELETE
    public function destroy(Supply $supply)
    {
        if ($supply->image) {
            Storage::disk('public')->delete($supply->image);
        }

        $supply->delete();

        return back()->with('success', 'Supply deleted.');
    }
}