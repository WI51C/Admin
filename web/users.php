<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

$crudl = new \CRUDL\CRUDL('localhost', 'root', 'password', 'admin', 'user');
$crudl->globalJoin('image', 'UserImage = ImageId');
$crudl->list->columns(['UserId', 'UserUsername', 'ImageText']);
$crudl->list->closure('UserId', function ($value) {
    return $value - 1;
});

echo $crudl->action($action);

require 'includes/bottom.php';