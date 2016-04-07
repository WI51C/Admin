<?php

require '../vendor/autoload.php';
require 'includes/top.php';

ini_set('xdebug.var_display_max_depth', 15);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

//$dataBuilder = new \CRUDL\Relations\DataBuilder(
//    ['UserId' => 'ID', 'UserUsername' => 'Username'],
//    [
//        [
//            'UserId'   => '1',
//            'UserName' => 'Thomas',
//        ],
//        [
//            'UserId'   => '2',
//            'UserName' => 'Mark',
//        ],
//    ]
//);
//$dataBuilder->subTable(['images' => 'Best Images EU'], [
//    [
//        [
//            'Image'     => 'src/thomas.png',
//            'ImageText' => 'Fucking shite',
//        ],
//        [
//            'Image'     => 'src/thomas.png',
//            'ImageText' => 'Thomas shite',
//        ],
//    ],
//    [
//        [
//            'Image'     => 'src/mark.png',
//            'ImageText' => 'Fucking shite',
//        ],
//        [
//            'Image'     => 'src/mark.png',
//            'ImageText' => 'Fucking abe',
//        ],
//    ],
//]);
//$dataBuilder->extend(['UserPassword' => 'Password'], [['UserPassword' => '1212123aokksdasd'], ['UserPassword' => 'sdaklkasdasd']]);
//var_dump($dataBuilder->build());

$action = isset($_GET['action']) ? $_GET['action'] : 'table';

$controller = new \CRUDL\Controller('127.0.0.1', 'root', 'password', 'admin', 'user');
$controller->table->map->newOTO(function ($relation) {
    $relation->joinTable('image');
    $relation->joinCondition('UserImage = ImageId');
});
$controller->table->columns(['UserId' => 'ID', 'UserUsername', 'UserPassword', 'ImageText']);
$controller->table->noescape(['UserId']);
$controller->table->closure('UserId', function ($value) {
    return "<a href='users.php?action=update&id=$value'>Update</a>";
});

echo $controller->action($action);

require 'includes/bottom.php';
