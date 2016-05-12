<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model {

    use ClanRelations;
}

trait ClanRelations {

    /**
     * retrieve message source user 
     * * */
    public function users() {
        return $this->belongsToMany('App\User');
    }

}
