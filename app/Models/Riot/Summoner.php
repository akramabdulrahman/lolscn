<?php

namespace App\Models\Riot;

use Illuminate\Database\Eloquent\Model;
use Servers;

class Summoner extends Model {

    protected $guarded = [
        'id'
    ];

    public function exists($unique) {
        return $this->where('riot_id', '=', $unique)->exists();
    }

    public function store($summoner,$region) {
       // dd($summoner);
        return Summoner::firstOrCreate([
        'riot_id' => $summoner->id,
        'name' => $summoner->name,
        'lvl' => $summoner->summonerLevel,
        'server' => $region,
        'Icon' => $summoner->profileIconId,
        ]);
    }
    
    public function users(){
        return $this->belongsToMany('App\User');
    }

}
