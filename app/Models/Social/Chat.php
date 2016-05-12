<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use DB;
class Chat extends Model {

    use ChatRelations;

    public function addUser($id) {
        return $this->users()->attach($id);
    }
    
    public function ChatSameUsersExist($to){
         return DB::table('chat_user')
                     ->select('chat_id')
                     ->from(DB::raw('(SELECT chat_id,GROUP_CONCAT(chat_user.user_id) as U FROM chat_user GROUP BY chat_user.chat_id) AS T'))
                     ->where('T.U','2,3')
                     ->get()[0];
         
    }
}

trait ChatRelations {

    /**
     * retrieve message target chat 
     * * */
    public function Messages() {
        return $this->hasMany('App\Models\Social\Message');
    }

    /**
     * retrieve message source user 
     * * */
    public function users() {
        return $this->belongsToMany('App\User');
    }

}
