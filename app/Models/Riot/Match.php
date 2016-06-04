<?php

namespace App\Models\Riot;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Match extends Model {

    protected $guarded = [
        'id'
    ];
    protected $dates = ['date'];

    public function riotnotifies() {
        return $this->morphMany('App\Models\Riot\Riotnotify', 'riotable');
    }

    public function getDateAttribute($value) {
        return Carbon::createFromTimeStamp(strtotime($value));
    }

    public function summoner() {
        return $this->belongsTo("App\Models\Riot\Summoner");
    }

    public function store($matches, $region) {
        $affected = [];
        $summoner = Summoner::where('riot_id', '=', $matches[key(($matches))])
                        ->where('server', '=', $region)->with('matches')->first();


        foreach ($matches['games'] as $key => $value) {
            //  $matchIds = $summoner->matches()->lists('riot_id')->toArray();
            //  if (!in_array($value['gameId'], $matchIds)) {
            $match = Match::firstOrCreate([
                        'Riot_Id' => (number_format ($value['gameId'],0,'.','')), 'summoner_id' => $summoner->id
            ]);
            if (!$match->final) {
                $match->update(
                        [
                            'win' => $value['stats']['win'],
                            'championId' => $value['championId'],
                            'spell1' => $value['spell1'],
                            'spell2' => $value['spell2'],
                            'item1' => isset($value['stats']['item0']) ? $value['stats']['item0'] : null,
                            'item2' => isset($value['stats']['item1']) ? $value['stats']['item1'] : null,
                            'item3' => isset($value['stats']['item2']) ? $value['stats']['item2'] : null,
                            'item4' => isset($value['stats']['item3']) ? $value['stats']['item3'] : null,
                            'item5' => isset($value['stats']['item4']) ? $value['stats']['item4'] : null,
                            'item6' => isset($value['stats']['item5']) ? $value['stats']['item5'] : null,
                            'item7' => isset($value['stats']['item6']) ? $value['stats']['item6'] : null,
                            'match_type' => $value['subType'],
                            'kills' => isset($value['stats']['championsKilled']) ? $value['stats']['championsKilled'] : 0,
                            'deaths' => isset($value['stats']['numDeaths']) ? $value['stats']['numDeaths'] : 0,
                            'assists' => isset($value['stats']['assists']) ? $value['stats']['assists'] : 0,
                            'level' => $value['stats']['level'],
                            'creeps' => isset($value['stats']['minionsKilled']) ? $value['stats']['minionsKilled'] : 0,
                            'duration' => $value['stats']['timePlayed'],
                            'date' => ((intval($value['createDate'] / 1000))),
                            'final' => 1,
                            'in_game' => 0
                ]);
            }
            $match->save();
            $affected[] = $match->id;
            // }
        }
        return $affected;
    }

}
