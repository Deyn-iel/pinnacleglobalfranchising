<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function updateAll(Request $request): RedirectResponse
{
    $user = $request->user();

    // ======================
    // VALIDATION
    // ======================
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'email',
            'max:255',
            'unique:users,email,' . $user->id,
        ],
        'current_password' => ['nullable', 'required_with:password'],
        'password' => ['nullable', 'confirmed', 'min:8'],
    ]);

    // ======================
    // UPDATE PROFILE INFO
    // ======================
    $user->name = $request->name;

    if ($user->email !== $request->email) {
        $user->email = $request->email;
        $user->email_verified_at = null;
    }

    // ======================
    // UPDATE PASSWORD (OPTIONAL)
    // ======================
    $passwordChanged = false;

    if ($request->filled('password')) {

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $passwordChanged = true;
    }

    $user->save();

    // ======================
    // OPTIONAL: LOGOUT IF PASSWORD CHANGED
    // ======================
    if ($passwordChanged) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Password changed');
    }

    return back()->with('status', 'updated');
}

}
