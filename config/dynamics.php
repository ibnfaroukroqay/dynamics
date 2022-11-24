<?php

// config for Ibnfaroukroqay/Dynamics
return [
    'auth_data' => [
        'resource' => env('DYNAMICS_RESOURCE'),
        'grant_type' => 'client_credentials',
        'scope' => 'openid',
        'client_id' => env('DYNAMICS_CLIENT_ID'),
        'client_secret' => env('DYNAMICS_CLIENT_SECRET'),
        'username' => env('DYNAMICS_USERNAME'),
        'password' => env('DYNAMICS_PASSWORD'),
    ],
    'auth_url' => env('DYNAMICS_AUTH_URL'),
    'url' => env('DYNAMICS_URL'),
];
