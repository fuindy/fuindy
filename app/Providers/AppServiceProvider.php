<?php

namespace Fuindy\Providers;

use Fuindy\Repositories\Notifications\v1\Services\PushNotification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); // fix for DB MySQL < 5.7 conflicts
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
        $this->app->bind('PushNotification', PushNotification::class);
    }
}
