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
class SummonerByIdLeague extends SummonerById {

    public function __construct() {
        $this->configIndex = 'summoner.by-id.league';
    }

    public function store($model, $stream, $region, $key = null) {
        $mod = new $model();
        $data = json_decode($stream->getContents(), TRUE);
        $mod->store(is_null($key) ? $data : $data[$key], $region);
        $league = new \App\Models\Riot\League();
        return $league->store(is_null($key) ? $data : $data[$key], $region);
    }

}
