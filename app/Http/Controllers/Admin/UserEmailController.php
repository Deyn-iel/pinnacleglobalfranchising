<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class UserEmailController extends Controller
{
    public function create()
    {
        return view('admin.users-account-email');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'type' => ['required', 'in:reset,invite'],
            'message' => ['nullable', 'string', 'max:500'],
        ]);

        // For most cases, "reset" is enough and standard.
        // This sends a reset link email using Laravel's built-in notifications.
        $status = Password::sendResetLink(['email' => $data['email']]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Password reset link sent successfully.');
        }

        return back()->with('error', __($status));
    }
}
