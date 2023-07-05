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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'paypal' => [
        'paypal_currency' => env('PAYPAL_CURRENCY','EGP'),
        'paypal_sandbox_client_username' => env('PAYPAL_SANDBOX_CLIENT_USERNAME'),
        'paypal_sandbox_client_password' => env('PAYPAL_SANDBOX_CLIENT_PASSWORD'),
        'paypal_sandbox_client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRETE'),
        'paypal_sandbox_client_certificate' => env('PAYPAL_SANDBOX_CLIENT_CERTIFICATE'),
        'paypal_callback_url'=>env('PAYPAL_CALLBACK_URL'),
        'paypal_error_url' => env('PAYPAL_ERROR_URL'),
    ],
    'stripe' => [
        'publishable_key' => env('STRIPE_PUBLISHABLE_KEY'),
        'secret_key' => env('STRIPE_SECRETE_KEY')
    ],
    'paymop' => [
        'token' => env('PAYMOP_TOKEN'),
        'base_url' => env('PAYMOP_BASE_URL')
    ],

    'google' => [
        'calendar_api_key'=>env('GOOGLE_CALENDAR_API_KEY'),
        'calendar_client_key'=>env('GOOGLE_CALENDAR_CLIENT_ID'),
        'calendar_client_secret'=>env('GOOGLE_CALENDAR_CLIENT_SECRET'),
        'calendar_id' => env('GOOGLE_CALENDAR_ID'),

    ]

];
