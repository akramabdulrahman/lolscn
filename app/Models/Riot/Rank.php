<?php

namespace App\Models\Riot;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model {

    protected $guarded = [
        'id'
    ];

    public function store($league, $region) {
        $summoner = Summoner::where('riot_id', '=', key(($league)))
                        ->where('server', '=', $region)->first();

// dd($summoner);
        $rank = '';
        foreach ($league as $key => $value) {
            $rank = $value[0]['tier'] . $value[0]['entries'][0]['division'];
        }

        $rankObj = Rank::firstOrCreate([
                    'summoner_id' => $summoner->id
        ]);
        $type = $rankObj->type;

        if ($rankObj->new_rank != config('ritoranks.' . $rank)['elo']) {
            if (!is_null($rankObj->last_rank)) {
                if (config('ritoranks.' . $rank)['elo'] > $rankObj->new_rank) {
                    $type = 'up';
                } else {
                    $type = 'down';
                }
            }


            $rankObj->update([
                'last_rank' => $rankObj->new_rank,
                'new_rank' => config('ritoranks.' . $rank)['elo'],
                'type' => $type
            ]);
        }
        return $rankObj;
    }

    public function summoner() {
        return $this->belongsTo('App\Models\Riot\Summoner');
    }

    public function riotnotifies() {
        return $this->morphMany('App\Models\Riot\Riotnotify', 'riotable');
    }

}
