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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google_maps' => [
        'key' => env('GOOGLE_MAPS_API_KEY'),
        'distance_origin' => env(
            'GOOGLE_MAPS_DISTANCE_ORIGIN',
            'Grote Markt 27, Groningen, Netherlands',
        ),
        // Alleen lokaal (Windows cURL 60): GOOGLE_MAPS_SSL_VERIFY=false
        // Ondersteunt ook: Google_SSL_verify=false
        'ssl_verify' => filter_var(
            env('GOOGLE_MAPS_SSL_VERIFY', env('Google_SSL_verify', true)),
            FILTER_VALIDATE_BOOLEAN,
        ),
    ],

];
