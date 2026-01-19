<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // COUNT ACTIVE USERS EXCEPT ADMIN
        $activeUsers = User::where('role', '!=', 'admin')->count();

        return view('admin.dashboard', compact('activeUsers'));
    }
}