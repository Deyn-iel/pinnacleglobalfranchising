<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class AdminDesktopOnly
{
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();

        // 🚫 Block mobile & tablet
        if ($agent->isMobile() || $agent->isTablet()) {
            abort(403, 'Admin access is allowed on desktop or laptop only.');
        }

        return $next($request);
    }
}
