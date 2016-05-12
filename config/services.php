<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |
      | This file is for storing the credentials for third party services such
      | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
      | default location for this type of information, allowing packages
      | to have a conventional place to find your various credentials.
      |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '1153621497994977',
        'client_secret' => '2f831d98dede1b76e554a7010bbf6852',
        'redirect' => 'http://lolscn.dev/login/callback/facebook',
    ],
    'google' => [
        'client_id' => '865519127022-9venbmufna48ajv0mtjbmu6jeph96o5m.apps.googleusercontent.com',
        'client_secret' => 'o5X-PQVfYRoypR-RR98iX8ub',
        'redirect' => 'http://lolscn.dev/login/callback/google',
    ],
];
