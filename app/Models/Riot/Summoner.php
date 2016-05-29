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
                redirect()->back()->with(array('error' => $ex));
            }
        }

        $matches = new EndPoints\SummonerByIdMatches;

        $match = R_API::get($matches->buildUrl(array(
                            'summonerIds' => $this->riot_id,
                            'region' => $this->server
        )));
        ($matches->store('\App\Models\Riot\Match', $match, $this->server));
        //opp$this->touch();
        return $this;
    }

    public function exists($unique) {
        return $this->where('riot_id', '=', $unique)->exists();
    }

    public function store($summon, $region) {
        // dd($summoner);
        $summoner = Summoner::firstOrCreate([
                    'riot_id' => $summon['id'],
                    'server' => $region,
        ]);
        if ($summoner->update([
                    'name' => $summon['name'],
                    'lvl' => $summon['summonerLevel'],
                    'Icon' => $summon['profileIconId'],
                ])) {
            return $summoner;
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
            'date' => intval($matches['gameStartTime'] / 1000),
            'duration' => $matches['gameLength'],
        ]);
        return $match;
    }

    public static function getSummonerFromRiot($summonerName, $region) {
        $sum = new EndPoints\SummonerByName();

        $summoner = R_API::get($sum->buildUrl(array(
                            'summonerNames' => strtolower($summonerName),
                            'region' => $region
        )));
        return $sum->store('\App\Models\Riot\Summoner', $summoner, $region, $summonerName);
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

    public static function search($summonerName, $region = null) {
        $result = null;
        if ($summoners = Summoner::where('name', 'like', "%$summonerName%")->get()) {
            return $summoners->all();
        } else {
            if ($region != null) {
                $result = Summoner::getSummonerFromRiot($summonerName, $region);
            } else {
                $result = [];
                foreach (config('ritosvrs') as $key => $value) {
                    $result[] = Summoner::getSummonerFromRiot($summonerName, $key);
                }
            }
        }
        return $result;
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function matches() {
        return $this->hasMany('App\Models\Riot\Match')->orderBy('date', 'desc');
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
