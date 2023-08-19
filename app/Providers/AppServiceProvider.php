<?php

namespace App\Providers;

use App\Contracts\Auth\AuthenticationServiceInterface;
use App\Contracts\Auth\RegistrationServiceInterface;
use App\Services\Auth\AuthenticationService;
use App\Services\Auth\RegistrationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RegistrationServiceInterface::class, RegistrationService::class);
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
