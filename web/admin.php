<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->presenter->columns(['UserPassword' => 'Password', 'ImageText' => 'Best']);
$controller->read->sql->relations->oto('Image', 'ImageId = UserImage');
$controller->read->sql->relations->otm('attributes', 'UserId', 'AttributeUserId', 'INNER', function ($table) {
    $table->presenter->columns([
                                   'AttributeText' => 'Denne person er:',
                               ]);
});
echo $controller->read->render();

require 'includes/bottom.php';
