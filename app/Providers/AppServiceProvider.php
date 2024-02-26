<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Channel;

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
        // * means share this varaible with every single view
        \View::composer('*', function ($view) {
            $view->with('channels', Channel::all());
        });

        // \View::share('channels', Channel::all());
    }
}
