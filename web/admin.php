<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->columns(['UserPassword' => 'Password']);
$controller->read->relations->oto('Image', 'ImageId = UserImage');
$controller->read->relations->otm(['attributes' => 'This person is:'], 'AttributeUserId = UserId');
echo $controller->action(array_key_exists('action', $_GET) ? $_GET['action'] : 'read');

require 'includes/bottom.php';
