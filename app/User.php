<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hootlex\Friendships\Traits\Friendable;
use Cmgmyr\Messenger\Traits\Messagable;
use App\Notification_type;
use App\Notification;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Activity;
use Illuminate\Contracts\Auth\CanResetPassword;
use Hash;
use App\Models\Social\Share;

class User extends Authenticatable implements CanResetPassword {

    use Messagable,
        Relations,
        Friendable,
        Scopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'country_id', 'email', 'facebook_token', 'facebook_id',
        'google_token', 'google_id', "nickname", 'password', 'mobile', 'dob'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates=['dob'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'facebook_token', 'facebook_id',
        'google_token', 'google_id',
    ];

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail() {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }

    public function toString() {
        return $this->name;
    }

//    public function setPasswordAttribute($value) {
//        $this->attributes['password'] = Hash::make($value);
//    }
    public function setdobAttribute($date) {
        $this->attributes['dob'] = new Carbon($date);
    }

    public function isLoggedUsingOauth() {
        return $this->google_token || $this->facebook_token ? 1 : 0;
    }

    public function hasPassword() {
        return ($this->password) ? 1 : 0;
    }

    public function scopeSearch($query, $search) {
        return $query->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                            ->orWhere('nickname', 'like', "%$search%");
                });
    }

}

trait Relations {

    /**
     * retrieve message target chat 
     * * */
    public function posts() {
        return $this->hasMany('App\Models\Social\Post');
    }

    /**
     * retrieve message source user 
     * * */
    public function chats() {
        return $this->belongsToMany('App\Models\Social\Chat');
    }

    /**
     * retrieve message source user 
     * * */
    public function clans() {
        return $this->belongsToMany('App\Models\Social\Clan');
    }

    /**
     * retrieve message source user 
     * * */
    public function summoners() {
        return $this->belongsToMany('App\Models\Riot\Summoner');
    }

    /**
     * retrieve likes made by user 
     * * */
    public function likes() {
        return $this->hasMany('App\Models\Social\Like');
    }
    

    /**
     * retrieve shares made by user 
     * * */
    public function shares() {
        return $this->hasMany('App\Models\Social\Share');
    }

    /**
     * retrieve user shared posts
     * 
     * @return Mixed 
     * * */
    public function shared() {
        return Share::Where('user_id', '=', $this->id)->where('share_type', '=', Models\Social\Share_type::SHARED_BY_USER)->get()->map(function ($item, $key) {
                    return $item->post;
                });
    }

    /**
     * retrieve user shared posts
     * 
     * @return Mixed 
     * * */
    public function sharedOnMyWall() {
        return Share::Where('user_id', '=', $this->id)->where('share_type', '=', Models\Social\Share_type::FRIEND_POSTED_ON_MY_WALL)->get()->map(function ($item, $key) {
                    return $item->post;
                });
    }

    /**
     * user belongs to country
     * * */
    public function country() {
        return $this->belongsTo('App\Country');
    }

    /**
     * user has Notifications
     * * */
    public function notifications() {
        return $this->hasMany('App\Notification');
    }

    /**
     * user has message Notifications
     * * */
    public function getLikesNotifications() {
        return Notification::where(array('user_id' => $this->id, 'Notification_type' => Notification_type::LIKE, 'read' => false));
    }

    /**
     * user has online friends
     * * */
    public function getOnlineFriends() {
        $activities = Activity::users(5)->get();
        $friends = $this->getFriends()->lists('id')->toarray();

        return $activities->filter(function ($item) use($friends) {
                    return in_array($item->user->id, $friends);
                })->map(function ($item, $key) {
                    $item->last_activity = Carbon::createFromTimestamp($item->last_activity)->diffForHumans();
                    return $item;
                });
    }

}

trait Scopes {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('userSummoners', function(Builder $builder) {
            
        });
    }

}
