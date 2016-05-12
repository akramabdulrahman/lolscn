<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Share extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id'
    ];

}
