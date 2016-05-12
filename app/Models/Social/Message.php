<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    use MessageRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','body', 'chat_id',
    ];
    
      /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['chat'];

}

trait MessageRelations {

    /**
     * retrieve message target chat 
     * * */
    public function chat() {
        return $this->belongsTo('App\Models\Social\Chat');
    }
    
    /**
     * retrieve message source user 
     * * */
    public function user() {
        return $this->belongsTo('App\User');
    }
    
}
