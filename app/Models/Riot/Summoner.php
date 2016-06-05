<?php

namespace App\Models\Riot;

use Illuminate\Database\Eloquent\Model;
use Servers;
use Illuminate\Database\Eloquent\Builder;
use Riot\Facades\Api as R_API;
use Riot\Facades\EndPoints;
use GuzzleHttp\Exception\ClientException;

class Summoner extends Model {

    protected $guarded = [
        'id'
    ];

    public function UpdateSummonerProps() {
        if ($this->lvl == 30) {
            try {
                $league = new EndPoints\SummonerByIdLeague();

                $rank = R_API::get($league->buildUrl(array(
                                    'summonerIds' => $this->riot_id,
                                    'region' => $this->server
                )));
                ($league->store('\App\Models\Riot\Rank', $rank, $this->server));
            } catch (ClientException $ex) {
                session()->flash('error', 'summoner is unranked');
            }
        }

        if ($this->lvl >= 10) {
            $matches = new EndPoints\SummonerByIdMatches;

            $match = R_API::get($matches->buildUrl(array(
                                'summonerIds' => $this->riot_id,
                                'region' => $this->server
            )));
            ($matches->store('\App\Models\Riot\Match', $match, $this->server));
        } else {
            session()->flash('error', 'matches will be loaded when summoner level reaches 10');
        }
        //opp$this->touch();
        return $this;
    }

    public function scopeExists($query, $unique) {

        return $query->where(function($query) use ($unique) {
                    $query-- > where('riot_id', '=', $unique);
                })->exists();
    }

    public function scopeSearch($query, $search) {
        $search = str_replace(' ', '', strtolower($search));

        return $query->where(function($query) use ($search) {
                    $query->where("name", 'SOUNDS LIKE', "%$search%");
                });
    }

    public function scopeMatch($query, $search) {
        $search = str_replace(' ', '', strtolower($search));
        
        return $query->where(function($query) use ($search) {
                    $query->where("name", '=', "$search");
                });
                
    }

    public function store($summon, $region) {
        // dd($summoner);
        if (!(empty($summon))) {
            $summoner = Summoner::firstOrCreate([
                        'riot_id' => $summon['id'],
                        'server' => $region,
            ]);
            if ($summoner->update([
                        'name' => $summon['name'],
                        'lvl' => $summon['summonerLevel'],
                        'Icon' => $summon['profileIconId'],
                    ])) {
                $summoner->UpdateSummonerProps();
                return $summoner;
            }
        } else {
            return null;
        }
    }

    public function ingame() {
        try {
            $current = new EndPoints\SummonerByIdCurrentMatch;

            $currentMatch = R_API::get($current->buildUrl(array(
                                'summonerIds' => $this->riot_id,
                                'region' => $this->server,
                                'platform' => config('ritosvrs.' . $this->server . '.platform')
            )));
            return ($current->store('\App\Models\Riot\Summoner', $currentMatch, $this->server, $this));
        } catch (ClientException $exc) {
            return null;
        }
    }

    public function storeCurrent($matches, $region, $summoner) {
        $sumkey = array_search($summoner->riot_id, array_column($matches['participants'], 'summonerId'));

        $match = Match::firstOrCreate([
                    'Riot_Id' => intval($matches['gameId']), 'championId' => $matches['participants'][$sumkey]['championId'], 'summoner_id' => $summoner->id, 'in_game' => 1,
                    'match_type' => isset($matches['gameQueueConfigId']) ? config('ritocurrmatchtypes.' . $matches['gameQueueConfigId']) : 0
        ]);
        $match->update([
            'date' => (intval($matches['gameStartTime'] / 1000)),
            'duration' => $matches['gameLength'],
        ]);
        return $match;
    }

    public function hasUser() {
        $user = $this->users()->first();
        return is_null($user) ? false : $user;
    }

    public static function getSummonerFromRiot($summonerName, $region) {
        try {
            //echo $region;
            $sum = new EndPoints\SummonerByName();

            $summoner = R_API::get($sum->buildUrl(array(
                                'summonerNames' => strtolower($summonerName),
                                'region' => $region
            )));
            return $sum->store('\App\Models\Riot\Summoner', $summoner, $region, $summonerName);
        } catch (ClientException $ex) {
            return null;
        }
    }

    public static function getSummonerFromRiotCrossRegion($summonerName) {
        $configSvrs = config('ritosvrs');
        $summoners = [];
        foreach ($configSvrs as $svr => $obj) {
            $summoners[$svr] = static::getSummonerFromRiot($summonerName, $svr);
        }
        return array_filter($summoners);
    }

    public function championsStatsFromRiot($season) {
        $champs = new EndPoints\SummonerByIdChamps();

        try {
            return R_API::get($champs->buildUrl(array(
                                'summonerIds' => strtolower($this->riot_id),
                                'region' => $this->server,
                                'season' => $season
            )));
        } catch (ClientException $exc) {
            return null;
        }
    }

//    public static function search($summonerName, $region = null) {
//        $result = null;
//        if ($summoners = Summoner::where('name', 'like', "%$summonerName%")->get()) {
//            return $summoners->all();
//        } else {
//            if ($region != null) {
//                $result = Summoner::getSummonerFromRiot($summonerName, $region);
//            } else {
//                $result = [];
//                foreach (config('ritosvrs') as $key => $value) {
//                    $result[] = Summoner::getSummonerFromRiot($summonerName, $key);
//                }
//            }
//        }
//        return $result;
//    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function matches() {
        return $this->hasMany('App\Models\Riot\Match');
    }

    public function rank() {
        return $this->hasone('App\Models\Riot\Rank');
    }

    public function league() {
        return $this->hasone('App\Models\Riot\League');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('summonerRank', function(Builder $builder) {
            $builder->with('rank');
        });
        static::addGlobalScope('summonerLeague', function(Builder $builder) {
            $builder->with('league');
        });
        static::addGlobalScope('summonerMatches', function(Builder $builder) {
            $builder->with('matches');
        });
        static::addGlobalScope('summonerusers', function(Builder $builder) {
            $builder->with('users');
        });
    }

}
