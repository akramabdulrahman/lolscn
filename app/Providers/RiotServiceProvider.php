<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Riot\Summoner;
use App\Models\Riot\Match;
use App\Models\Riot\Riotnotify;
use App\Models\Riot\Rank;

class RiotServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Summoner::created(function ($SummonerObject) {
            //$SummonerObject->UpdateSummonerProps();
        });

        Match::created(function($match) {
            $summoner = $match->summoner()->first();
            $type = $match->in_game ? 'IN_GAME' : 'MATCH';

            if (!Riotnotify::where(array('riotable_id' => $match->id, 'riotable_type' => 'App\Models\Riot\Match'))->exists()) {
                $notif = Riotnotify::create([
                            'summoner_id' => $summoner->id,
                            'type' => 'MATCH'
                ]);
                $match->riotnotifies()->save($notif);
            }
        });
        Match::updated(function($match) {
            $summoner = $match->summoner()->first();
            $type = $match->in_game ? 'IN_GAME' : 'MATCH';
            if (!Riotnotify::where(array('riotable_id' => $match->id, 'riotable_type' => 'App\Models\Riot\Match'))->exists()) {

                $notif = Riotnotify::create([
                            'summoner_id' => $summoner->id,
                            'type' => $type
                ]);
                $match->riotnotifies()->save($notif);
            }
        });

        Rank::updated(function($rank) {
            if (!($rank->last_rank == 0)) {
                $summoner = $rank->summoner()->first();

                $notif = Riotnotify::firstorcreate([
                            'summoner_id' => $summoner->id,
                            'type' => 'RANK'
                ]);
                $rank->riotnotifies()->save($notif);
            
            }
        });
        Summoner::updated(function ($SummonerObject) {
            $SummonerObject->UpdateSummonerProps();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
