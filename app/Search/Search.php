<?php

namespace Search;

use App\Models\Riot\Summoner;
use App\User;
use Illuminate\Support\Collection;
use Helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of search
 *
 * @author blackthrone
 */
class Search {

    public static function users($search, $paging = 10) {
        $search = strtolower($search);

        return ['profiles' => User::search($search)->get()];
    }

    public static function summoners($search, $paging = 10) {
        $search = strtolower($search);

        if (!Helpers::is_arabic($search)) {
            if (strlen($search) >= 4) {
                if (Summoner::match($search)->get()->count() === 0) {

                    return ['summoners' => Summoner::getSummonerFromRiotCrossRegion($search)];
                }
                return ['summoners' => Summoner::search($search)->get()];
            }
        }
        return ['summoners' => []];
    }

    public static function champions($search) {
        $search = strtolower($search);

        $champs = config('ritochamps');
        $champ = preg_grep('~' . strtolower(preg_quote($search, '~')) . '~', array_map('strtolower', $champs));

        return new Collection($champ);
    }

    public static function all($search) {
        $search = strtolower($search);

        $summoners = static::summoners($search);
        $profiles = static::users($search);
        $champions = static::champions($search);

        return (new Collection(['profiles' => $profiles['profiles'], 'summoners' => $summoners['summoners'], 'champions' => $champions]));
    }

}
