<?php

namespace App\Http\Controllers;

use Auth;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()) {
            $auth_user_id = Auth::user()->id;
            $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();
            $page = 'feed';
            //$threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();
            return view('home')->with(compact('page', 'posts', 'auth_user_id'));
        } else {
            return view('landing');
        }
    }

}