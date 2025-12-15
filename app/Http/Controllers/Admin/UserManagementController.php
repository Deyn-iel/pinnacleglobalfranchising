<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users-account', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // 🔐 AUTO-GENERATE PASSWORD
        $plainPassword = Str::random(10);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($plainPassword), // ✅ FIX
            'temp_password' => $plainPassword,              // ✅ FIX
            'usertype'      => 'user',
        ]);

        return redirect()
            ->route('admin.users-account')
            ->with('success', 'User registered successfully! Temporary Password: ' . $plainPassword);
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        User::findOrFail($id)->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
