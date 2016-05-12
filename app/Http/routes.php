<?php

use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Social\Post;
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
//auth Login

Route::auth();

$this->get('password/reset/{token?}', array('middleware'=>'delog','uses'=>'Auth\PasswordController@showResetForm'));

//auth Login end

Route::get('/', 'HomeController@index');


Route::get('/home', 'HomeController@index');


//
//Social Login
Route::get('/login/{provider?}', [
    'uses' => 'Auth\SocialAuthController@getSocialAuth',
    'as' => 'auth.getSocialAuth'
]);

Route::get('/login/callback/{provider?}', [
    'uses' => 'Auth\SocialAuthController@getSocialAuthCallback',
    'as' => 'auth.getSocialAuthCallback'
]);

//Social Login end
//email verification 
Route::get('/verify', 'Auth\EmailVerificationController@sendVerification');
Route::get('/verify/confirm/{token}', 'Auth\EmailVerificationController@confirmEmail');
//email verification  end
//messages 
Route::resource('messages', 'MessagesController');
Route::get('/messages/user/{id}', 'MessagesController@messageToUser');

//messages end
//posts
Route::post('/post', 'PostsController@store');

//posts end
//comments 
Route::group(['prefix' => 'comments'], function () {
    Route::post('/post', ['as' => 'comments.storeOnPost', 'uses' => 'CommentsController@storeOnPost']);
    Route::post('/comment', ['as' => 'comments.storeOnComment', 'uses' => 'CommentsController@storeOnComment']);
});
//comments end
//likes
// Like Post

Route::group(['prefix' => 'likes'], function () {
    Route::get('/post/{id}', ['as' => 'likes.storeOnPost', 'uses' => 'LikesController@storeOnPost']);
    Route::get('delete/post/{id}', ['as' => 'likes.deleteOnPost', 'uses' => 'LikesController@deleteOnPost']);
    Route::get('/comment/{id}', ['as' => 'likes.storeOnComment', 'uses' => 'LikesController@storeOnComment']);
    Route::get('delete/comment/{id}', ['as' => 'likes.deleteOnComment', 'uses' => 'LikesController@deleteOnComment']);
});

//likes end
//friendship begin
Route::group(['prefix' => 'friendship'], function () {
    Route::get('/befriend/{id}', ['as' => 'friendship.befriend', 'uses' => 'FriendShipController@befriend']);
    Route::get('/accept/{id}', ['as' => 'friendship.accept', 'uses' => 'FriendShipController@accept']);
    Route::get('/decline/{id}', ['as' => 'friendship.decline', 'uses' => 'FriendShipController@decline']);
    Route::get('/unfriend/{id}', ['as' => 'friendship.unFriend', 'uses' => 'FriendShipController@unFriend']);
});
//friendship end
//posts
Route::get('/profile/settings', 'ProfileContoller@create');
Route::resource('/profile', 'ProfileContoller');
Route::post('/profile/update_cover', 'ProfileContoller@changeCoverImage');
Route::post('/profile/update_avatar', 'ProfileContoller@changeProfileImage');

//posts end

Route::get('/a7a', function() {
//
//    $activities = Activity::users(60)->get();
//    $friends = Auth::user()->getFriends()->lists('id')->toarray();
//
//    $activities = $activities->filter(function ($item) use($friends) {
//                return in_array($item->user->id, $friends);
//            })->map(function ($item, $key) {
//        return $item->last_activity = $item->last_activity->diffForHumans();
//    });
//    ;
// Last 1 minute)
    // dd(Auth::user()->getOnlineFriends());
 //   dd(Auth::user()->hasPassword());
   // return view('add_summoner');
     $like= Auth::user()->getLikesNotifications()->first()->notifyable()->first()->likable()->get();
    return dd($like );
   // return Post::find(4);
});

Route::post('newpass', 'User\UserController@newPassword');

Route::post('profile/update', 'ProfileContoller@update')->name('user.update');

Route::get('images/cover/{userID}', function($userID) {
    $filepath = storage_path() . User::find($userID)->cover;
    return Response::download($filepath);
});
Route::get('images/profile/{userID}', function($userID) {
    $filepath = storage_path() . User::find($userID)->avatar;
    return Response::download($filepath);
});
