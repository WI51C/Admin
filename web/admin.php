<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->presenter->columns(['UserPassword' => 'Password', 'ImageText' => 'Best']);
$controller->read->sql->relations->oto('Image', 'ImageId = UserImage');
$controller->read->sql->relations->otm('attributes', 'AttributeUserId = UserId');
echo $controller->read->render();

require 'includes/bottom.php';
