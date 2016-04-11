<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->presenter->columns(['UserUsername' => 'Username', 'UserPassword' => 'Password', 'ImageText' => 'Best']);
$controller->read->presenter->caption('Users');
$controller->read->sql->relations->oto('Image', 'ImageId = UserImage');
$controller->read->sql->relations->otm('attributes', 'UserId', 'AttributeUserId', 'INNER', function ($table) {
    $table->alias('Attributes');
    $table->presenter->columns([
                                   'AttributeText' => 'Denne person er:',
                               ]);
});
echo $controller->read->render();

require 'includes/bottom.php';

$tal1 = 1;
$tal2 = 2;
$sum  = $tal1 + $tal2;
$tal1 = 5;