<?php

return [
    'header' => 'Header',
    'connection' => [
        'hostname' => 'localhost',
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