<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
           // Using class based composers...
        View::composer('profile', 'App\Http\ViewComposers\NotificationsComposer');

        // Using Closure based composers...
        View::composer('dashboard', function($view)
        {

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
