<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

$controller = new \CRUDL\CrudController('127.0.0.1', 'root', 'password', 'admin', 'user');
$controller->table->join('image', 'ImageId = UserImage', 'INNER');
$controller->table->columns(['UserId' => 'ID', 'UserUsername', 'UserPassword', 'ImageText']);
$controller->table->noescape(['UserId']);
$controller->table->closure('UserId', function ($value) {
    return "<a href='users.php?action=update&id=$value'>Update</a>";
});

echo $controller->action($action);

require 'includes/bottom.php';
