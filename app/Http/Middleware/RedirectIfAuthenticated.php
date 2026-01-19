<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // Allow access to login route even if authenticated (prevents redirect loop)
                if ($request->routeIs('login') || $request->routeIs('auth.login')) {
                    return $next($request);
                }

                // Admin goes to admin dashboard
                if (Auth::user() && Auth::user()->usertype === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                // Regular user goes to normal dashboard
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
