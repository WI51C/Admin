<?php

use CRUDL\CRUDL;

require '../vendor/autoload.php';
require 'includes/top.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

$crudl = new CRUDL('127.0.0.1', 'root', 'password', 'admin', 'user');
$crudl->list->join('image', 'ImageId = UserImage', 'INNER');
$crudl->list->columns(['UserId' => 'ID', 'UserUsername', 'UserPassword', 'ImageText']);
$crudl->list->noescape(['UserId']);
$crudl->list->closure('UserId', function ($value) {
    return "<a href='users.php?action=update&id=$value'>Update</a>";
});

echo $crudl->action($action);

require 'includes/bottom.php';
