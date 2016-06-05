<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model {

    use ClanRelations;
}

trait ClanRelations {

    /**
     * clan has many users    
     * * */
    public function users() {
        return $this->belongsToMany('App\User');
    }
    /**
     * clan has posts 
     * * */
    public function posts() {
        return $this->hasMany('App\Models\Social\Post');
    }

}
trait ClanScopes {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('clanPosts', function(Builder $builder) {
            $builder->with('posts');
        });
        static::addGlobalScope('clanUsers', function(Builder $builder) {
            $builder->with('users');
        });

      
    }

}
