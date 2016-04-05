<?php

return [
    'header'     => 'Header',
    'connection' => [
        'hostname' => '127.0.0.1',
        'username' => 'root',
        'password' => 'password',
        'database' => 'admin',
        'charset'  => 'utf8',
    ],
    'aliases'    => [
        'user' => 'Users',
    ],
    'tables'     => [
        'user' => [
            'alias'  => 'Users',
            'joins'  => [
                ['image', 'UserImage = ImageId', 'INNER'],
            ],
            'inputs' => [
                'UserId'       => [
                    'hidden' => true,
                ],
                'UserUsername' => [
                    'type'   => 'string',
                    'length' => 64,
                    'alias'  => 'Username',
                ],
                'UserEmail'    => [
                    'type'   => 'email',
                    'length' => 127,
                    'alias'  => 'Email',
                ],
                'UserPassword' => [
                    'type'   => 'password',
                    'length' => 64,
                    'alias'  => 'Password',
                ],
                'UserLevel'    => [
                    'type'   => 'int',
                    'length' => 4,
                    'alias'  => 'Level',
                ],
            ],
        ],
    ],
];