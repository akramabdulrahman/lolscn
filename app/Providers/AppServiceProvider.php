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
                ['profile','clan','clans', 'partials.profile.profileinfo', 'settings','partials.ticker.ticker', 'home', 'messsages', 'partials.notification.fixed', 'partials.notification.friends', 'partials.notification.messages','champions','summoner'], 'App\Http\ViewComposers\NotificationsComposer'
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
