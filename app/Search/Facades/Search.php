<?php namespace Search\Facades;
 use Illuminate\Support\Facades\Facade;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author blackthrone
 */
class Search extends Facade {

    protected static function getFacadeAccessor() {
        return 'search';
    }
}
