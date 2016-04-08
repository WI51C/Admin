<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->oto('image', 'ImageId = UserImage');
$controller->read->modifiers->apply(['UserID'], 'strtolower');
echo $controller->action(array_key_exists('action', $_GET) ? $_GET['action'] : 'read');

require 'includes/bottom.php';
