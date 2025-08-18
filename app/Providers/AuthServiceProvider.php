<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function boot(): void
    {
        // Only super_admin can access admin routes
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'super_admin';
        });
    }
}
