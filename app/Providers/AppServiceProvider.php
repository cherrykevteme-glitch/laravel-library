<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\SmsSender;
use App\Services\Sms\LogSmsSender;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       
        $this->app->singleton(SmsSender::class, function () {
            return match (config('services.sms.driver')) {
                'log'   => new LogSmsSender(),
                default => new LogSmsSender(), 
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}