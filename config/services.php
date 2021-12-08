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
    'facebook' => [
        'client_id' => '220975646584895',  //client face của bạn
        'client_secret' => 'e8fde3e33bf129f25b85061b31631556',  //client app service face của bạn
        'redirect' => 'http://localhost/FinalProject/admin/callback' //callback trả về
    ],
    'facebook' => [
        'client_id' => '575805903790137',  //client face của bạn
        'client_secret' => 'd52a10be7f3d288a377a46a456d842ea',  //client app service face của bạn
        'redirect' => 'http://localhost/FinalProject/customer/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '854225784461-jb7a5a6v5m3gmehdpsq18fki41hj9rm8.apps.googleusercontent.com',
        'client_secret' => 'ouPud5gITN3LnZFVVstu7XLI',
        'redirect' => 'http://localhost/FinalProject/google/callback'
    ],
    'google' => [
        'client_id' => '854225784461-na8ial9jrepqj4fkjp5orm0cqfru73k1.apps.googleusercontent.com',
        'client_secret' => 'wFm72hoMX190dRVbVq96OjRv',
        'redirect' => 'http://localhost/FinalProject/googlecustomer/callback'
    ],

];
