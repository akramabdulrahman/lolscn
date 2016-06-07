<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model {

    use CommentRelations,
        CommentScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'body'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['commentable'];

}

trait CommentRelations {

    /**
     * comment morphs post.
     *
     * @return Post
     */
    public function post() {
        return $this->morphTo('App\Models\Social\Post');
    }

    /**
     * the commentable target of the comment.
     *
     * @return Comment or Post
     */
    public function commentable() {
        return $this->morphTo();
    }

    /**
     * Comment has many comments.
     *
     * @return Mixed
     */
    public function comments() {
        return $this->morphMany('App\Models\Social\Comment', 'commentable');
    }

    /**
     * Comment belongs to a user.
     *
     * @return User
     */
    public function user() {
        return $this->belongsTo('App\User');
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
     * comment morphs notification.
     *
     * @return Post
     */
    public function notification() {
        return $this->morphOne('App\Notification','notifyable');
    }

}

trait CommentScopes {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('commentsoncomments', function(Builder $builder) {
            $builder->with('comments');
        });
        static::addGlobalScope('commentuser', function(Builder $builder) {
            $builder->with('user');
        });

        static::addGlobalScope('likesoncomment', function(Builder $builder) {
            $builder->with('likes');
        });
    }

}
