<?php
//
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return [
     'api_key' => 'd7625f15-8f8d-48f8-850e-e687ee241f06',
    'base_url_eune' => [
        'endpoint' => 'https://eune.api.pvp.net/{url}',
    ],
    'base_url_euw' => [
        'endpoint' => 'https://euw.api.pvp.net/{url}',
    ],
    'base_url_na' => [
        'endpoint' => 'https://na.api.pvp.net/{url}',
    ],
    'base_url_br' => [
        'endpoint' => 'https://br.api.pvp.net/{url}',
    ],
    'base_url_oce' => [
        'endpoint' => 'https://oce.api.pvp.net/{url}',
    ],
    'base_url_ru' => [
        'endpoint' => 'https://ru.api.pvp.net/{url}',
    ],
    'base_url_tr' => [
        'endpoint' => 'https://tr.api.pvp.net/{url}',
    ],
    'base_url_las' => [
        'endpoint' => 'https://las.api.pvp.net/{url}',
    ],
    'base_url_lan' => [
        'endpoint' => 'https://lan.api.pvp.net/{url}',
    ],
    'base_url_kr' => [
        'endpoint' => 'https://kr.api.pvp.net/{url}',
    ],
    'summoner.by-name' => [
        'required' => array('region', 'summonerNames'),
        'endpoint' => '/api/lol/{region}/v1.4/summoner/by-name/{summonerNames}'
    ],
    'summoner.by-id' => [
        'required' => array('region', 'summonerIds'),
        'endpoint' => '/api/lol/{region}/v1.4/summoner/{summonerIds}'
    ],
    'summoner.by-id.league' => [
        'required' => array('region', 'summonerIds'),
        'endpoint' => '/api/lol/{region}/v2.5/league/by-summoner/{summonerIds}/entry'
    ],
    'summoner.by-id.runes' => [
        'required' => array('region', 'summonerIds'),
        'endpoint' => '/api/lol/{region}/v1.4/summoner/{summonerIds}/runes'
    ],
    'summoner.by-id.matches' => [
        'required' => array('region', 'summonerIds'),
        'endpoint' => '/api/lol/{region}/v1.3/game/by-summoner/{summonerIds}/recent'
    ],
    'summoner.by-id.currentmatch' => [
        'required' => array('region','platform', 'summonerIds'),
        'endpoint' => '/observer-mode/rest/consumer/getSpectatorGameInfo/{platform}/{summonerIds}'
    ],
    'summoner.by-id.champs' => [
        'required' => array('region', 'summonerIds','season'),
        'endpoint' => '/api/lol/{region}/v1.3/stats/by-summoner/{summonerIds}/ranked?season={season}'
    ],
    'summoner.masteries.by-id' => [
        'required' => array('region', 'summonerIds'),
        'endpoint' => '"/api/lol/{region}/v1.4/summoner/{summonerIds}/masteries"'
    ],
];

