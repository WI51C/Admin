<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->presentation->columns(['UserUsername' => 'Username', 'UserPassword' => 'Password', 'ImageText' => 'Image Text']);
$controller->read->presentation->caption('Users');
$controller->read->select->relations->oto('Image', 'ImageId = UserImage');
$controller->read->modifiers->add('UserUsername', 'ucwords');
$controller->read->select->relations->otm('attributes', 'UserId', 'AttributeUserId', 'INNER', function ($table) {
    $table->alias('Attributes');
    $table->presentation->columns([
                                      'AttributeText' => 'Denne person er:',
                                  ]);
});
echo $controller->read->render();

require 'includes/bottom.php';

$tal1 = 1;
$tal2 = 2;
$sum  = $tal1 + $tal2;
$tal1 = 5;