<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //
    }
    public static function redirectTo()
{
    if (Auth::check()) {
        return Auth::user()->role === 'admin' ? '/dashboard/admin' : '/dashboard/guru';
    }
    return '/login';
}

}
