<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * After login, users are redirected here.
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route config.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            // WEB ROUTES
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // API ROUTES
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }

    /**
     * Configure Rate Limiting
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });
    }
}
