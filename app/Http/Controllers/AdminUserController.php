<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function create()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ], [
            'email.unique' => 'This email is already registered.',
        ]);

        $tempPassword = Str::random(8);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($tempPassword),
            'temp_password' => $tempPassword,
            'is_admin'      => 0,
        ]);

        return redirect()
            ->route('admin.users-account')
            ->with('success', 'User registered successfully.');
    }
}


