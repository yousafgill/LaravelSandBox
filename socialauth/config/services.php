<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
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
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '91384328217-hoptkog30i7r03b6fafa1ufdhhtnj9lh.apps.googleusercontent.com',
        'client_secret' => 'oQfdglDp9CRqV5Y2QUTg4JqD',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',

    ],
    'facebook' => [
        'client_id' => '590912454926668',
        'client_secret' => '9f29c05335a4ba581f63a378d95b0978',
        'redirect' => 'http://127.0.0.1:8000/auth/facebook/callback',

    ],
];
