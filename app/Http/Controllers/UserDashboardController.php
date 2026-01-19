<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Active users EXCEPT admin
        $activeUsers = User::where('role', '!=', 'admin')->count();

        return view('user-dashboard.dashboard', compact('activeUsers'));
    }
}