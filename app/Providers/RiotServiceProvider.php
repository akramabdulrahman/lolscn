<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Riot\Summoner;
use App\Models\Riot\Match;
use App\Models\Riot\Riotnotify;
use App\Models\Riot\Rank;
use App\Models\Social\Post;

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
                $post = null;
                if ($user = $summoner->hasUser()) {

                    $post = Post::Create([
                                'user_id' => $user->id,
                                'post_type' => config('posttypes.' . 'RIOTNOTIF')
                    ]);
                }
                $notif = Riotnotify::create([
                            'summoner_id' => $summoner->id,
                            'type' => 'MATCH',
                            'post_id' => is_null($post) ? 0 : $post->id
                ]);
                $match->riotnotifies()->save($notif);
            }
        });
        Match::updated(function($match) {
            $summoner = $match->summoner()->first();
            $type = $match->in_game ? 'IN_GAME' : 'MATCH';
            if (!Riotnotify::where(array('riotable_id' => $match->id, 'riotable_type' => 'App\Models\Riot\Match'))->exists()) {
                $post = null;
                if ($user = $summoner->hasUser()) {

                    $post = Post::Create([
                                'user_id' => $user->id,
                                'post_type' => config('posttypes.' . 'RIOTNOTIF')
                    ]);
                }
                $notif = Riotnotify::create([
                            'summoner_id' => $summoner->id,
                            'type' => $type,
                            'post_id' => is_null($post) ? 0 : $post->id
                ]);

                $match->riotnotifies()->save($notif);
            }
        });

        Rank::updated(function($rank) {
            if (!($rank->last_rank == 0)) {
                $summoner = $rank->summoner()->first();
                $post = null;
                if ($user = $summoner->hasUser()) {

                    $post = Post::Create([
                                'user_id' => $user->id,
                                'post_type' => config('posttypes.' . 'RIOTNOTIF')
                    ]);
                }
                $notif = Riotnotify::firstorcreate([
                            'summoner_id' => $summoner->id,
                            'type' => 'RANK',
                            'post_id' => is_null($post) ? 0 : $post->id
                ]);
                $rank->riotnotifies()->save($notif);
            }
        });
        Summoner::updated(function ($SummonerObject) {
            //$SummonerObject->UpdateSummonerProps();
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
