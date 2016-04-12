<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$controller = new Admin\CRUD('localhost', 'root', 'password', 'admin', 'user');
$controller->read->presentation->caption('Users');
$controller->read->database->relations->oto('Image', 'ImageId = UserImage');
$controller->read->database->relations->mtm('roles', 'UserID', 'UserId', 'roles_user_relation', 'roles.RoleID = roles_user_relation.RoleID', 'INNER', function ($table) {
    $table->alias('Roller');
    $table->presentation->columns(['RoleName' => 'Denne person har disse roller:']);
});
$controller->read->presentation->attribute('class', 'html-class');
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
