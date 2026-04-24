<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if ($request->routeIs('login') || $request->routeIs('auth.login')) {
                    return $next($request);
                }

                $user = Auth::user();

                if ($user->usertype === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                if ($user->usertype === 'supplies') {
                    return redirect()->route('supplies.supplies-dashboard');
                }

                if ($user->usertype === 'ticket') {
                    return redirect()->route('tickets.dashboard');
                }

                if ($user->usertype === 'portal') {
                    return redirect()->route('portal.dashboard');
                }
                if ($user->usertype === 'smm') {
                    return redirect()->route('admin.portals.smm');
                }

                if ($user->usertype === 'hr') {
                    return redirect()->route('admin.portals.hr');
                }

                if ($user->usertype === 'om') {
                    return redirect()->route('admin.portals.om');
                }

                if ($user->usertype === 'od') {
                    return redirect()->route('admin.portals.od');
                }

                if ($user->usertype === 'it') {
                    return redirect()->route('admin.portals.it');
                }

                if ($user->usertype === 'admin-secretary') {
                    return redirect()->route('admin.portals.admin-secretary');
                }

                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
