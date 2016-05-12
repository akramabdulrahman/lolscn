<?php

namespace App\Http\Controllers;

use App\Models\Social\Post;
use App\Models\Social\Comment;
use Auth;
use App\Models\Social\Like;
use Validator;

class LikesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function storeOnPost($id) {
        $post = Post::where('id', $id)->firstOrFail();
        $post->likes()->save($this->createLike($id, 0));
        return redirect()->away("/");
    }

    public function storeOnComment($id) {
        $comment = Comment::where('id', $id)->firstOrFail();
        $comment->likes()->save($this->createLike($id, 1));
        return redirect()->away("/");
    }

    function createLike($id, $type) {

        return Like::firstOrNew([
                    'user_id' => Auth::user()->id,
                    'likable_id' => $id,
                    'likable_type' => ($type == 0) ? 'App\Models\Social\Post' : 'App\Models\Social\Comment'
        ]);
    }

    public function deleteOnPost($id) {
        Like::where(array('user_id' => Auth::user()->id, 'likable_id' => $id, 'likable_type' => 'App\Models\Social\Post'))->delete();
        return redirect()->away("/");
    }

    public function deleteOnComment($id) {
        Like::where(array('user_id' => Auth::user()->id, 'likable_id' => $id, 'likable_type' => 'App\Models\Social\Comment'))->delete();
        return redirect()->away("/");
    }

}
