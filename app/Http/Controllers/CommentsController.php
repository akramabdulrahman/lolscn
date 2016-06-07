<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social\Post;
use App\Models\Social\Comment;
use Auth;

class CommentsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'body' => 'required|max:800'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOnPost(Request $request) {
        validator($request->all());
        $post = Post::where('id', $request->input('commentable_id'))->firstOrFail();
        $post->comments()->save($this->createComment($request->input('body')));
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOnComment(Request $request) {
        validator($request->all());
        $ParentComment = Comment::where('id', $request->input('commentable_id'))->firstOrFail();
        $ParentComment->comments()->save($this->createComment($request->input('body')));
        return redirect()->away("/");
    }

    function createComment($body) {
        return new Comment([
            'body' => $body,
            'user_id' => Auth::user()->id,
        ]);
    }

    public function delete($id) {
        $comment = Comment::findorfail($id);
        $msg = [];
        if (Auth::user()->id === $comment->user_id) {
            $comment->delete();
            $msg = array('status' => 'comment deleted successfully');
        } else {
            $msg = array('error' => 'you dont have authority');
        }
        return redirect()->back()->with($msg);
    }

}
