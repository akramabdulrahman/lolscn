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

        return str_replace('{url}', $this->config[$this->configIndex]['endpoint'], $url) . "?api_key=" . Config('rito.api_key');
    }

    public function buildBaseUrl($region) {
        return $this->baseUrl = Config('rito.base_url_' . $region)['endpoint'];
    }

    public function store($model, $stream,$region, $key=null) {
        $mod = new $model();
        $data = json_decode($stream->getContents());
       return $mod->store(empty($key) ? $data : $data->$key,$region);
    }

}
