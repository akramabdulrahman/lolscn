<?php

namespace App\Http\Controllers;
use  App\Models\Social\Post;
use Auth;

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
        ]);


        return redirect()->away("/");
    }

}
