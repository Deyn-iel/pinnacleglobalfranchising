<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;
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
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'hr.access' => HrAccessMiddleware::class,

        // ✅ ADD THESE
        'redirect.dashboard.role' => \App\Http\Middleware\RedirectDashboardByRole::class,
        'noback' => \App\Http\Middleware\NoBackButton::class,
    ]);

    $middleware->validateCsrfTokens(except: [
        'logout',
        'user/logout',
    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (TokenMismatchException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Your session expired. Please refresh the page and try again.',
                ], 419);
            }

            return redirect()
                ->route('login')
                ->with('status', 'Your session expired. Please log in again.');
        });
    })->create();
