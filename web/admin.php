<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->presentation->caption('Users');
$controller->read->database->relations->oto('Image', 'ImageId = UserImage');
$controller->read->modifiers->add('UserUsername', 'ucwords');
$controller->read->presentation->columns([
                                             'UserUsername' => 'Username',
                                             'UserPassword' => 'Password',
                                             'UserEmail'    => 'Email',
                                             'ImageText'    => 'Image',
                                         ]);
$controller->read->database->relations->otm('attributes', 'UserId', 'AttributeUserId', function ($table) {
    $table->alias('Attributes');
    $table->presentation->columns([
                                      'AttributeText' => 'Denne person er:',
                                  ]);
});
echo $controller->read->render();

require 'includes/bottom.php';
