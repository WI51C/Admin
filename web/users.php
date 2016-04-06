<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

$crudl = new \CRUDL\CRUDL('127.0.0.1', 'root', 'Password', 'admin', 'user');
$crudl->globalJoin('image', 'UserImage = ImageId');
$crudl->list->columns(['UserId', 'UserUsername', 'ImageText']);
$crudl->list->closure('UserId', function ($value) {
    return '<a href="users.php?update=' . $value . '">Hello world</a>';
});

echo $crudl->action($action);

require 'includes/bottom.php';