<?php
return [
    'connections' => [
        'rbac' => [
            'driver'      => 'mysql',
            'host'        => env('DB_HOST', '127.0.0.1'),
            'port'        => env('DB_PORT', '3306'),
            'database'    => env('DB_DATABASE', 'forge'),
            'username'    => env('DB_USERNAME', 'forge'),
            'password'    => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset'     => 'utf8',
            'collation'   => 'utf8_general_ci',
            'prefix'      => env('DB_RBAC_PREFIX', 'rbac_'),
            'strict'      => true,
            'engine'      => null,
        ],
    ],
];
