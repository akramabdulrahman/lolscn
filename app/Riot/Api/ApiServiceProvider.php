<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Riot\Api;

use Illuminate\Support\ServiceProvider;

/**
 * Description of ApiServiceProvider
 *
 * @author blackthrone
 */
class ApiServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind('search', 'Riot\Api\Api');
    }

}
