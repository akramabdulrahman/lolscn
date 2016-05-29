<?php

namespace Riot\Facades;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Facade;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Exception\ClientException;
use Riot\Exceptions\WrongHttpResponse;

/**
 * Description of Api
 *
 * @author blackthrone
 */
class Api extends Facade {

    public static function get($url) {
        $client = new HttpClient([
            'verify' => false
        ]);
            $res = $client->get($url);
        

        return $res->getBody();
    }

    public static function get_async($url) {

        $client = new HttpClient([
            'verify' => false
        ]);
        $promise = $client->getAsync($url, ['future' => true]);
        $promise->then(function(ResponseInterface $res) {
            echo $res->getStatusCode() . "\n";

            dd('success', $res);
        }, function(RequestException $e) {
            dd($e);
        });
//        $response = $client->get($url, ['future' => true]);
//        $response->then(function ($response) {
//            if ($res->getStatusCode() != 200) {
//                throw new WrongHttpResponse('The HTTP Response Code Recieved By Riot was : ' . $res->getStatusCode() . "!= 200");
//            }
//            return $response->getBody();
//        });
    }

    protected static function getFacadeAccessor() {
        return 'api/facades';
    }

}
