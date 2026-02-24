<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminDesktopOnly;
use App\Http\Middleware\HrAccessMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'admin.desktop' => \App\Http\Middleware\AdminDesktopOnly::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'hr.access' => HrAccessMiddleware::class,

        // ✅ ADD THESE
        'redirect.dashboard.role' => \App\Http\Middleware\RedirectDashboardByRole::class,
        'noback' => \App\Http\Middleware\NoBackButton::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
