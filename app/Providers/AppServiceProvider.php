<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\MessageObserver;
use App\Message;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Message::observe(MessageObserver::class);
    }
}
