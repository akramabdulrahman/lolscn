<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Like extends Model {

    use LikeRelations,
        LikeScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['Likable'];

}

trait LikeRelations {

    /**
     * Like morphs post.
     *
     * @return Post
     */
    public function post() {
        return $this->morphTo('App\Models\Social\Post');
    }
    /**
     * Like morphs post.
     *
     * @return Post
     */
    public function notification() {
        return $this->morphOne('App\Notification','notifyable');
    }
    /**
     * Like morphs post.
     *
     * @return Post
     */
    public function comment() {
        return $this->morphTo('App\Models\Social\Comment');
    }

    /**
     * the commentable target of the comment.
     *
     * @return Comment or Post
     */
    public function Likable() {
        return $this->morphTo();
    }

    /**
     * Comment belongs to a user.
     *
     * @return User
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

}

trait LikeScopes {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */ 


    protected static function boot() {
        parent::boot();
        static::addGlobalScope('thepostthatwasliked', function(Builder $builder) {
           //$builder->with('post');
        });
    }

}
