<?php

require '../vendor/autoload.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

$crudl = new \CRUDL\CRUDL('localhost', 'root', 'password', 'admin', 'user');
$crudl->globalJoin('image', 'UserImage = ImageId');

echo $crudl->action($action);