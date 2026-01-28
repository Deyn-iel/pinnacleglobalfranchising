<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index()
    {
        $supplies = Supply::latest()->get();
        return view('admin.supplies', compact('supplies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'unit'          => 'required',
            'cost_price'    => 'required|numeric',
            'selling_price' => 'required|numeric',
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

        return back()->with('success', 'Supply added successfully');
    }
}


