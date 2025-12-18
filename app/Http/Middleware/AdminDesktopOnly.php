<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;

class AdminDesktopOnly
{
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();

        if ($agent->isMobile() || $agent->isTablet() || $agent->isIpad()) {

            // Force logout
            Auth::logout();

            // Prevent session issues
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('error', 'Admin access is available on desktop or laptop only.');
        }

        return $next($request);
    }
}
