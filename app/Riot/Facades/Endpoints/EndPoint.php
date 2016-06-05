<?php

namespace Riot\Facades\EndPoints;

use Riot\Exceptions\WrongHttpResponse as WrongHttpResponse;
use Illuminate\Config\Repository as Config;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author blackthrone
 */
abstract class EndPoint {

    private $baseUrl, $config;
    protected $configIndex;

    public function buildUrl($requiredParamsArray) {
        $url = $this->buildBaseUrl($requiredParamsArray['region']);
        $this->config = Config('rito');
        foreach ($this->config[$this->configIndex]['required'] as $param) {
            $this->config[$this->configIndex]['endpoint'] = str_replace('{' . $param . '}', $requiredParamsArray[$param], $this->config[$this->configIndex]['endpoint']);
        }
        $base = str_replace('{url}', $this->config[$this->configIndex]['endpoint'], $url);
        $del= (strpos($base, '?'))?'&':'?';
        return $base .$del. "api_key=" . Config('rito.api_key');
    }

    public function buildBaseUrl($region) {
        return $this->baseUrl = Config('rito.base_url_' . $region)['endpoint'];
    }

    public function store($model, $stream,$region, $key=null) {
        $mod = new $model();
        $data = json_decode($stream->getContents(),TRUE);
       return $mod->store(is_null($key) ? $data : $data[str_replace(' ', '', $key)],$region);
    }

}
