<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'google' => [
    'client_id' =>'265447426286-f1j18srv884j4m38g6v1t5a1pj7sk30t.apps.googleusercontent.com',
    'client_secret' => 'XtlOQ78sjEfCOfXFRAVVV9BL',
    'redirect' => 'http://localhost:8000/login/google/callback',
        ],

    'github' => [
    'client_id' =>'31df6c9bbee91faf40d3',
    'client_secret' => '6c7d94174e21dd8d1d779680d0ba75a8bc1b3909',
    'redirect' => 'http://localhost:8000/login/github/callback',
        ],
        
    'recaptcha'=>[
      'secret'=>env('RECAPTCHA_SECRET'),
    ]

];
