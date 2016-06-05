<?php

namespace App\Http\Controllers;

use App\Models\Social\Post;
use Auth;
use App\Models\Social\Share;
use App\Models\Social\Share_type;
use Illuminate\Http\Request;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    protected function validator(array $data) {

        return Validator::make($data, [
                    'body' => 'required|max:800'
        ]);
    }

    public function store(Request $request) {
        validator($request->all());
        Post::create([
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id,
            'post_type'=>config('posttypes.USERMADE')
        ]);


        return redirect()->back();
    }
    public function storeOnClan($clan_id,Request $request) {
        validator($request->all());
        Post::create([
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id,
            'post_type'=>config('posttypes.CLANPOST'),
            'clan_id'=>$clan_id
        ]);


        return redirect()->back();
    }

    public function storeOnFriendWall(Request $request) {
        validator($request->all());
        $post = Post::create([
                    'body' => $request->input('body'),
                    'user_id' => Auth::user()->id,
        ]);

        Share::Create([
            'user_id' => $request->input('id'),
            'post_id' => $post->id,
            'share_type' => Share_type::FRIEND_POSTED_ON_MY_WALL
        ]);

        return redirect()->back();
    }

    public function delete($id) {
        $post = Post::findorfail($id);
        $msg = [];
        if (Auth::user()->id === $post->user_id) {
            $post->delete();
            $msg = array('status' => 'post deleted successfully');
        } else {
            $msg = array('error' => 'you dont have authority');
        }
        return redirect()->back()->with($msg);
    }

}
