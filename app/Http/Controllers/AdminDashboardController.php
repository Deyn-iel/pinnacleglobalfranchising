<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('usertype','!=','admin')->count();

        $activeUsers = User::whereNotNull('last_seen_at')
            ->where('usertype','!=','admin')
            ->count();

        return view('admin.admin', compact(
            'totalUsers',
            'activeUsers'
        ));
    }
}