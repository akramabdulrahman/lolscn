<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Notification_type;
use App\Notification;
use App\Models\Social\Like;
use App\Models\Social\Comment;
use App\Models\Social\Share;

class NotificationsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Like::created(function ($like) {

            $likable = $like->likable;
            $ownerid = $likable->user_id;
            if ($like->user_id != $ownerid) {
                $notif = Notification::firstOrNew([
                            'user_id' => $ownerid,
                            'other_user_id' => $like->user_id,
                            'notification_type' => Notification_type::LIKE,
                ]);

                $notif->count = $likable->likes->count();
                $like->notification()->save($notif);
            }
        });
        Comment::created(function ($comment) {

            $commentable = $comment->commentable()->first();
            $ownerid = $commentable->user_id;

            if ($commentable instanceof \App\Models\Social\Post) {

                if ($comment->user_id !== $ownerid) {
                    $notif = Notification::firstOrNew([
                                'user_id' => $ownerid,
                                'other_user_id' => $comment->user_id,
                                'notification_type' => Notification_type::COMMENT,
                    ]);

                    $notif->count = $commentable->comments->count();
                    $comment->notification()->save($notif);
                }
            } else if ($commentable instanceof \App\Models\Social\Comment) {
                if ($comment->user_id !== $ownerid) {
                    $notif = Notification::firstOrNew([
                                'user_id' => $ownerid,
                                'other_user_id' => $comment->user_id,
                                'notification_type' => Notification_type::COMMENTONCOMMENT,
                    ]);

                    $notif->count = $commentable->comments->count();
                    $comment->notification()->save($notif);
                }

                //}
                //notifcation for $meesage->to
                // notifyable
            }
        });
        Share::created(function ($share) {

            $post = $share->post()->first();
            $ownerid = $post->user_id;
            if ($share->user_id != $ownerid) {
                $notif = Notification::firstOrNew([
                            'user_id' => $share->user_id,
                            'other_user_id' => $ownerid,
                            'notification_type' => Notification_type::Share,
                ]);

                $notif->count = 1;
                $share->notification()->save($notif);
            }
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
