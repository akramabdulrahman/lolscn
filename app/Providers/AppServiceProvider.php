<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        view()->composer(
                ['profile', 'partials.profile.profileinfo', 'settings', 'home', 'messsages', 'partials.notification.fixed', 'partials.notification.friends', 'partials.notification.messages'], 'App\Http\ViewComposers\NotificationsComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }

}
