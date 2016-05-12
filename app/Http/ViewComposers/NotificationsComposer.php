<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Hootlex\Friendships\Models\Friendship;
use Auth;
use Cmgmyr\Messenger\Models\Thread;
use Hootlex\Friendships\Status;
use App\country;

/**
 * Description of NotificationsComposer
 *
 * @author blackthrone
 */
class NotificationsComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $view->with('currentUser', Auth::user());
        $view->with('friendRequests', Friendship::WhereRecipient(Auth::user())->whereStatus(Status::PENDING)->get());
        $view->with('unseenMessages', Thread::forUserWithNewMessages(Auth::user()->id)->latest('updated_at')->distinct('id')->get());
        $view->with('likesNotifications', Auth::user()->getLikesNotifications());
        $view->with('onlineFriends', Auth::user()->getOnlineFriends());
        $view->with('countries', Country::lists('name', 'id'));
    }

}
