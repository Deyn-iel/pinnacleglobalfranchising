<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function create()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'usertype' => 'required|in:admin,user,supplies,ticket,portal,smm,hr,om,od,it,admin-secretary',
        ], [
            'email.unique' => 'This email is already registered.',
        ]);

        $tempPassword = Str::random(8);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'usertype'      => $request->usertype,
            'password'      => Hash::make($tempPassword),
            'temp_password' => $tempPassword,
        ]);

        return redirect()
            ->route('admin.users-account')
            ->with('success', 'User registered successfully.');
    }
}



