<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;
use App\Models\Riot\Summoner;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VerificationMailer
 *
 * @author blackthrone
 */
class SummonerVerificationMailer {

    /**
     * The Laravel Mailer instance.
     *
     * @var Mailer
     */
    protected $mailer;

    /**
     * The sender of the email.
     *
     * @var string
     */
    protected $from;

    /**
     * The recipient of the email.
     *
     * @var string
     */
    protected $to;

    /**
     * The view for the email.
     *
     * @var string
     */
    protected $view;

    /**
     * The data associated with the view for the email.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new app mailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer) {
        $this->from = env('MAIL_USERNAME', 'elofightdev@gmail.com');
        $this->mailer = $mailer;
    }

    /**
     * Deliver the email confirmation.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailConfirmationTo(User $user,summoner $summoner) {
        $token = str_random(16);
        $user->token =  $token;
        $summoner->token = $token;
        $user->save();
        $summoner->save();
        $this->to = $user->email;
        $this->view = 'emails.summoner_verification';
        $this->data = compact('user','summoner');
        $this->deliver();
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver() {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->from, 'Administrator')
                    ->to($this->to);
        });
    }

}
