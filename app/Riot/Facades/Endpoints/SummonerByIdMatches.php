<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Riot\Facades\EndPoints;

/**
 * Description of SummonerById
 *
 * @author blackthrone
 */
class SummonerByIdMatches extends SummonerById {

    public function __construct() {
        $this->configIndex = 'summoner.by-id.matches';   
    }
    
   

}
