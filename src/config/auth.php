<?php
return [
    'guards'    => [
        'web' => [
            'driver'   => 'rbac',
            'provider' => 'users',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\User::class,
        ],
    ]
];
