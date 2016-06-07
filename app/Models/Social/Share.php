<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Share extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id','share_type'
    ];
    
    public function post(){
        return $this->belongsTo('App\Models\Social\Post');
    }
    
    /**
     * share morphs notif.
     *
     * @return Post
     */
    public function notification() {
        return $this->morphOne('App\Notification','notifyable');
    }
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('withpost', function(Builder $builder) {
            $builder->with('post');
        });

     
    }
}
