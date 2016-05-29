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

}
