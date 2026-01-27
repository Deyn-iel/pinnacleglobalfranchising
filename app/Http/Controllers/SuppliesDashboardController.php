<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuppliesDashboardController extends Controller
{
    public function index()
    {
        return view('supplies.supplies-dashboard');
    }
}
