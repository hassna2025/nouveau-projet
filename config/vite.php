<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Vite Server URL
    |--------------------------------------------------------------------------
    |
    | The URL where the Vite development server is running.
    |
    */
    'server' => env('VITE_SERVER', 'http://localhost:5173'),

    /*
    |--------------------------------------------------------------------------
    | Manifest Path
    |--------------------------------------------------------------------------
    |
    | The path to the Vite manifest file.
    |
    */
    'manifest_path' => public_path('build/manifest.json'),

    /*
    |--------------------------------------------------------------------------
    | Build Directory
    |--------------------------------------------------------------------------
    |
    | The directory where Vite will place your built assets.
    |
    */
    'build_path' => public_path('build'),

    /*
    |--------------------------------------------------------------------------
    | Asset URL
    |--------------------------------------------------------------------------
    |
    | The base URL for your built assets in production.
    |
    */
    'asset_url' => env('VITE_ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Input
    |--------------------------------------------------------------------------
    |
    | The entry points for your application.
    |
    */
    'input' => [
        'resources/js/app.js',
        'resources/css/app.css',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Attributes
    |--------------------------------------------------------------------------
    |
    | The default attributes for script and style tags.
    |
    */
    'default_attributes' => [
        'script' => [
            'type' => 'module',
        ],
        'style' => [
            'rel' => 'stylesheet',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Variables
    |--------------------------------------------------------------------------
    |
    | Environment variables to inject into the Vite client.
    |
    */
    'env_variables' => [
        // Exemple :
        // 'APP_ENV' => env('APP_ENV'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Dev Server Ping Timeout
    |--------------------------------------------------------------------------
    |
    | The number of seconds to wait for the Vite dev server to respond.
    |
    */
    'ping_timeout' => 1,

    /*
    |--------------------------------------------------------------------------
    | Dev Server Ping Interval
    |--------------------------------------------------------------------------
    |
    | The number of seconds between pings to the Vite dev server.
    |
    */
    'ping_interval' => 0.1,
];