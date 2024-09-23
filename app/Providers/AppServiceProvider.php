<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        $this->app->bind(\App\Contracts\TelegramServiceInterface::class, \App\Services\TelegramService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(\Laravel\Cashier\Events\SubscriptionStarted::class, \App\Listeners\SendFirstPaymentPaidNotification::class);

        DB::listen(function ($query) {
            Log::info('Query: ' . $query->sql . ' | ' . json_encode($query->bindings));
        });
    }
}
