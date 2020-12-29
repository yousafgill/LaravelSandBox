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
        'client_id' => '91384328217-ukbst0b1i0hl1nigllbo6mfuftc5gcup.apps.googleusercontent.com',
        'client_secret' => 'fO96K7WtLkoEu0AEO2NY5hYQ',
        'redirect' => 'https://seedv1.siliconinterface.com/auth/google/callback',

    ],
    'facebook' => [
        'client_id' => '351919082919636',
        'client_secret' => 'd9cc557f52610e603e247514f08aea79',
        'redirect' => 'https://seedv1.siliconinterface.com/auth/facebook/callback',

    ],
];