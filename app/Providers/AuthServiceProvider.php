<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('isAdmin', function ($user) {
            // support BOTH styles
            return (bool)($user->is_admin ?? false) || (($user->usertype ?? null) === 'admin');
        });
    }
}