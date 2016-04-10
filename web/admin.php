<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->columns(['UserPassword' => 'Password', 'ImageText' => 'Best']);
$controller->read->relations->oto('Image', 'ImageId = UserImage');
$controller->read->relations->otm(['attributes' => 'This person is:'], 'AttributeUserId = UserId');
echo $controller->read->render();

require 'includes/bottom.php';
