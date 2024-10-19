<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Pagination\Paginator;
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
        date_default_timezone_set('Africa/Cairo');
        
        Paginator::useBootstrapFour();
    }
}
