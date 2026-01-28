<?php

namespace App\Http\Controllers;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SuppliesDashboardController extends Controller
{
    public function index()
{
    $supplies = Supply::latest()->get();
    return view('supplies.supplies-dashboard', compact('supplies'));
}
}

