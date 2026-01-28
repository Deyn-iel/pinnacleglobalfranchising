<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StrictAuth
{
    public function handle(Request $request, Closure $next)
    {
        // ❌ not logged in → login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 🚨 IF ANY ERROR / INVALID STATE → FORCE LOGOUT
        try {
            return $next($request);
        } catch (\Throwable $e) {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }
    }
}
