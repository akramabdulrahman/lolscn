<?php namespace Search;
use Illuminate\Support\ServiceProvider;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of searchServiceProvider
 *
 * @author blackthrone
 */
class SearchServiceProvider extends ServiceProvider {

    public function register(){
        $this->app->bind('search', 'Search\Search');
    }
}
