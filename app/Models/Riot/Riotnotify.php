<?php

namespace App\Models\Riot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Riotnotify extends Model {

    protected $guarded = [
        'id'
    ];
    protected $dates = ['date'];

     public function riotable() {
        return $this->morphto();
    }

    public function summoner(){
        return $this->belongsTo('App\Models\Riot\Summoner');
    }
    public function post(){
        return $this->belongsTo('App\Models\Social\Post');
    }
     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('riotable', function(Builder $builder) {
            $builder->with('riotable');
        });
     
    }

    public  function buildMsg($type,$requiredParamsArray) {
        $config = Config('ritonotiftypes.'.$type);
        foreach ($config['required'] as $param) {
            $config['txt'] = str_replace('{' . $param . '}', $requiredParamsArray[$param], $config['txt']);
        }
        return $config['txt'];
    }


}
