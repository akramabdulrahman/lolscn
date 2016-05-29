<?php

namespace App\Models\Riot;

use Illuminate\Database\Eloquent\Model;

class League extends Model {

    protected $guarded = [
        'id'
    ];

    public function store($league, $region) {
        $summoner = Summoner::where('riot_id', '=', key(($league)))
                        ->where('server', '=', $region)->first();

// dd($summoner);


        $leagueObj = League::firstOrCreate([
                    'summoner_id' => $summoner->id
        ]);

        $leagueEntries = $league[key($league)][0];
//return $leagueEntries;
        $leagueObj->update([
            'queue_name' => $leagueEntries['name'],
            'leaguepts' => $leagueEntries['entries'][0]['leaguePoints'],
            'wins' => $leagueEntries['entries'][0]['wins'],
            'losses' => $leagueEntries['entries'][0]['losses'],
            'in_series' => isset($leagueEntries['entries'][0]['miniSeries']) ? implode(',', $leagueEntries['entries'][0]['miniSeries']) : null,
            'fresh_blood' => $leagueEntries['entries'][0]['isFreshBlood'],
            'hotstreak' => $leagueEntries['entries'][0]['isHotStreak'],
            'veteran' => $leagueEntries['entries'][0]['isVeteran'],
            'inactive' => $leagueEntries['entries'][0]['isInactive'],
        ]);
        return $leagueObj;
    }

    public function summoner() {
        return $this->belongsTo('App\Models\Riot\Summoner');
    }

}
