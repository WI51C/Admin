<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\Controller('localhost', 'root', 'password', 'admin');
$controller->table->map->newOTO(function ($relation) {
    $relation->joinTable('image');
    $relation->joinCondition('UserImage = ImageId');
});
$controller->table->columns(['UserId' => 'ID', 'UserUsername', 'UserPassword', 'ImageText']);
$controller->table->noescape(['UserId']);
$controller->table->closure('UserId', function ($value) {
    return "<a href='users.php?action=update&id=$value'>Update</a>";
});

echo $controller->action(array_key_exists('action', $_GET) ? $_GET['action'] : 'table');

require 'includes/bottom.php';
