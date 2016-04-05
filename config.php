<?php

return [
    'connection' => [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'Password',
        'database' => 'admin',
        'charset'  => 'utf8',
    ],
    'tables'     => [
        'alias' => [
            'user' => 'Users'
        ],
        'user'  => [
            'UserId' => [
                'hidden' => true
            ],
            'UserUsername' => [
                'type' => 'string',
                'length' => 64,
                'alias' => 'Username',
            ],
            'UserEmail' => [
                'type' => 'email',
                'length' => 127,
                'alias' => 'Email',
            ],
            'UserPassword' => [
                'type' => 'password',
                'length' => 64,
                'alias' => 'Password',
            ],
            'UserLevel' => [
                'type' => 'int',
                'length' => 4,
                'alias' => 'Level',
            ],
        ],
    ],
];