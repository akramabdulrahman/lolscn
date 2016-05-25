<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Notification_type;
use App\Notification;
use App\Models\Social\Like;
use App\Models\Social\Comment;

class NotificationsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Like::created(function ($like) {

            $post = $like->likable;
            $ownerid = $post->user_id;
            //  if ($like->user_id != $ownerid){
            $notif = Notification::firstOrNew([
                        'user_id' => $ownerid,
                        'other_user_id' => $like->user_id,
                        'notification_type' => Notification_type::LIKE,
            ]);

            $notif->count = $post->likes->count();
            $like->notification()->save($notif);
            //}
            //notifcation for $meesage->to
            // notifyable
        });
        Comment::created(function ($comment) {

            $commentable = $comment->commentable();
            $ownerid = $commentable->first()->user_id;

            if ($commentable instanceof \App\Models\Social\Post) {
                //  if ($like->user_id != $ownerid){
                $notif = Notification::firstOrNew([
                            'user_id' => $ownerid,
                            'other_user_id' => $comment->user_id,
                            'notification_type' => Notification_type::COMMENT,
                ]);

                $notif->count = $commentable->comments->count();
                $comment->notification()->save($notif);
            }

            //}
            //notifcation for $meesage->to
            // notifyable
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
