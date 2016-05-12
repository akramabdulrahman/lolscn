<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class FriendShipController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    /**
     * send a friend request
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function befriend($id) {
        
        if (!(Auth::user()->id == $id)) {
            Auth::user()->befriend(User::findOrFail($id));
        }
        return back();
    }

    /**
     * accept friendship
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accept($id) {
        if (!(Auth::user()->id == $id)) {
            return back()->with(Auth::user()->acceptFriendRequest(User::findOrFail($id)));
        }
        return back();
    }

    /**
     * decline friendship
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decline($id) {
        if (!(Auth::user()->id == $id)) {
            return back()->with(Auth::user()->denyFriendRequest(User::findOrFail($id)));
        }
        return back();
    }

    /**
     * unfriend other user (remove friendship)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unFriend($id) {
        if (!(Auth::user()->id == $id)) {
            return back()->with(Auth::user()->unfriend(User::findOrFail($id)));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

}
