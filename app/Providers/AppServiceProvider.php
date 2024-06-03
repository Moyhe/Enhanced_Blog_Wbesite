<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Routing\UrlGenerator;
=======
>>>>>>> origin/main
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
<<<<<<< HEAD
    public function boot(UrlGenerator $url): void
    {
        if (app()->environment() == 'production')
            $url->forceScheme('https');
=======
    public function boot(): void
    {
        //
>>>>>>> origin/main
    }
}
