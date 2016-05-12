<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Notification extends Model {

    use NotificationRelations,
        NotificationScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_type',
        'user_id',
        'other_user_id',
    ];

}

trait NotificationRelations {

    public function notifyable() {
        return $this->morphto();
    }


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function otherUser() {
        return $this->belongsTo('App\User', 'other_user_id');
    }

}

trait NotificationScopes {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('NotificationForUser', function(Builder $builder) {
            $builder->with('user');
        });
        static::addGlobalScope('userWhoMadeTheNotification', function(Builder $builder) {
            $builder->with('otherUser');
        });

        static::addGlobalScope('getTheObjectThatTriggeredTheNotification', function(Builder $builder) {
            $builder->with('notifyable');
        });
    }

}
