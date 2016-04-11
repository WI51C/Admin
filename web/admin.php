<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->presentation->columns(['UserUsername' => 'Username', 'UserPassword' => 'Password', 'ImageText' => 'Image Text']);
$controller->read->presentation->caption('Users');
$controller->read->select->relations->oto('Image', 'ImageId = UserImage');
$controller->read->modifiers->add('UserUsername', 'ucwords');
$controller->read->select->relations->otm('attributes', 'UserId', 'AttributeUserId', function ($table) {
    $table->alias('Attributes');
    $table->presentation->columns([
                                      'AttributeText' => 'Denne person er:',
                                  ]);
});
echo $controller->read->render();

require 'includes/bottom.php';
