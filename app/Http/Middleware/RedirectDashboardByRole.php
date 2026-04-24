<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectDashboardByRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

if (!$user) {
    return redirect()->route('login');
}

if ($request->routeIs('dashboard')) {

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
if ($user->usertype === 'smm' && !$request->routeIs('admin.portals.smm')) {
    return redirect()->route('admin.portals.smm');
}

if ($user->usertype === 'hr' && !$request->routeIs('admin.portals.hr')) {
    return redirect()->route('admin.portals.hr');
}

if ($user->usertype === 'om' && !$request->routeIs('admin.portals.om')) {
    return redirect()->route('admin.portals.om');
}

if ($user->usertype === 'od' && !$request->routeIs('admin.portals.od')) {
    return redirect()->route('admin.portals.od');
}

if ($user->usertype === 'it' && !$request->routeIs('admin.portals.it')) {
    return redirect()->route('admin.portals.it');
}

if ($user->usertype === 'admin-secretary' && !$request->routeIs('admin.portals.admin-secretary')) {
    return redirect()->route('admin.portals.admin-secretary');
}
        }
        return $next($request);
    }
}