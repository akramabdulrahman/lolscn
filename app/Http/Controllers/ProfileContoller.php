<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProfileContoller extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        $postsWithoutShared = $user->posts()->orderBy('created_at', 'desc')->get();
        $postsIshared = $user->shared()->merge($postsWithoutShared);
        $posts = $user->sharedOnMyWall()->merge($postsIshared)->sortByDesc('created_at');
        
        $currentUser = $user = Auth::user();
        return view('profile', compact('user', 'posts', 'currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('settings');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::findOrFail($id);
        $postsWithoutShared = $user->posts()->orderBy('created_at', 'desc')->get();
        $postsIshared = $user->shared()->merge($postsWithoutShared);
        $posts = $user->sharedOnMyWall()->merge($postsIshared)->sortByDesc('created_at');

        $currentUser = Auth::user();
        return view('profile', compact('user', 'posts', 'currentUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $user = Auth::user();



        try {
            $values = Input::only($user->getFillable());
            $user->update($values);
            // dd($user,$values);
        } catch (Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }

    protected function valid($name, $data) {
        return Validator::make($data, [
                    "$name" => 'required|image|max:10000',
        ]);
    }

    public function changeProfileImage(Request $request) {
        $validator = $this->valid('avatar', array('avatar' => Input::file('avatar')));
        if (!$validator->fails()) {
            $file = Input::file('avatar');
            $photoname = uniqid();
            ($file->move(storage_path() . '\uploads\avatars\\', $photoname . '.' . $file->guessClientExtension()));
            $user = Auth::user();
            $user->avatar = '\uploads\avatars\\' . $photoname . '.' . $file->guessClientExtension();
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    public function changeCoverImage() {
        $validator = $this->valid('cover', array('cover' => Input::file('cover')));
        if (!$validator->fails()) {
            $file = Input::file('cover');
            $photoname = uniqid();
            ($file->move(storage_path() . '\uploads\covers\\', $photoname . '.' . $file->guessClientExtension()));
            $user = Auth::user();
            $user->cover = '\uploads\covers\\' . $photoname . '.' . $file->guessClientExtension();
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

}
