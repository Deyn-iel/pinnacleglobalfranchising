<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UserNotification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 🔔 Share unread notification count to header globally
        View::composer('user-dashboard.partials-dashboard.header', function ($view) {

            $unreadCount = 0;

            if (Auth::check()) {
                $unreadCount = UserNotification::where('user_id', Auth::id())
                    ->whereNull('read_at')
                    ->count();
            }

            $view->with('unreadCount', $unreadCount);
        });
    }
}