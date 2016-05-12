<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    use CountryRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];

}

trait CountryRelations {

    /**
     * country  hasMany a user.
     *
     * @return User
     */
    public function users() {
        return $this->hasMany('App\User');
    }

}
