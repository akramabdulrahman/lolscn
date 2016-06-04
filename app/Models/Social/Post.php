<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model {

    use PostRelations,
        PostScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'body','post_type'
    ];

}

trait PostRelations {

    /**
     * post has many comments.
     *
     * @return Mixed
     */
    public function comments() {
        return $this->morphMany('App\Models\Social\Comment', 'commentable');
    }

    /**
     * post has one notifyable.
     *
     * @return Mixed
     */
    public function riotnotify() {
        return $this->hasOne('App\Models\Riot\Riotnotify');
    }

    /**
     * post has many likes.
     *
     * @return Mixed
     */
    public function likes() {
        return $this->morphMany('App\Models\Social\Like', 'likable');
    }

    /**
     * retrieve post shares
     * 
     * @return Mixed 
     * * */
    public function shares() {
        return $this->hasMany('App\Models\Social\Share');
    }

    /**
     * post belongs to a user.
     *
     * @return User
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

}

trait PostScopes {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('commentsonpost', function(Builder $builder) {
            $builder->with('comments');
        });

        static::addGlobalScope('likesonpost', function(Builder $builder) {
            $builder->with('likes');
        });
        static::addGlobalScope('postuser', function(Builder $builder) {
            $builder->with('user');
        });
    }

}
