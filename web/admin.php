<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$connection = new \Admin\Connection('localhost', 'root', 'password', 'admin');
$read       = (new \Admin\Read\Read($connection));
$read->setTable('user');
$read->setCaption('Users');
$read->columns->add('userusername', 'Username', 1);
$read->relations->addOto('image', 'image.ImageId = user.UserImage');
$read->relations->addMtm('roles', 'user.UserId', 'roles_user_relation.UserID', 'roles_user_relation', 'roles.RoleID = roles_user_relation.RoleID', 'INNER')->columns->displayAll();
$read->relations->addOtm('attributes', 'user.UserId', 'attributes.AttributeUserId')->columns->displayAll();

echo $read->render();

require 'includes/bottom.php';
