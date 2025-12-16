<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        
        $request->authenticate();
        $request->session()->regenerate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Clear temp password after first login
        if ($user && $user->temp_password) {
            $user->update(['temp_password' => null]);
        }

        if ($user->usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
// <?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\View\View;
// use Jenssegers\Agent\Agent;

// class AuthenticatedSessionController extends Controller
// {
//     /**
//      * Display the login view.
//      */
//     public function create(): View
//     {
//         return view('auth.login');
//     }

//     /**
//      * Handle an incoming authentication request.
//      */
//     public function store(LoginRequest $request): RedirectResponse
//     {
//         // 🔐 Authenticate user
//         $request->authenticate();
//         $request->session()->regenerate();

//         /** @var \App\Models\User $user */
//         $user = Auth::user();
//         $agent = new Agent();

//         // 🔒 BLOCK ADMIN LOGIN ON MOBILE / TABLET
//         if ($user->is_admin && ($agent->isMobile() || $agent->isTablet())) {

//             Auth::logout();
//             $request->session()->invalidate();
//             $request->session()->regenerateToken();

//             return redirect('/login')->withErrors([
//                 'email' => 'Admin login is allowed on desktop or laptop only.',
//             ]);
//         }

//         // 🧹 Clear temp password after first login
//         if ($user->temp_password) {
//             $user->update(['temp_password' => null]);
//         }

//         // 🔀 REDIRECT BASED ON ROLE
//         if ($user->is_admin) {
//             return redirect()->route('admin.dashboard');
//         }

//         return redirect()->route('dashboard');
//     }

//     /**
//      * Destroy an authenticated session.
//      */
//     public function destroy(Request $request): RedirectResponse
//     {
//         Auth::guard('web')->logout();

//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect('/');
//     }
// }
