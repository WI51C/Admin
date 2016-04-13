<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$connection = new \Admin\Connection('localhost', 'root', 'password', 'admin');
$read       = new \Admin\Read\Read($connection);
$read->setTable('user');
$read->setCaption('USERS');
$read->columns->addColumn('user.userid', 'ID', 2);
$read->columns->addColumn('user.userusername', 'Username', 1);
$read->relations->newOTO('image', 'image.ImageId = user.UserImage');
$read->relations->newMTM('roles', 'user.UserId', 'roles_user_relation.UserID', 'roles_user_relation', 'roles.RoleID = roles_user_relation.RoleID', 'INNER')
                ->setCaption('Roles')
                ->setAlias('Roles');
$read->relations->newOTM('attributes', 'user.UserId', 'attributes.AttributeUserId')
                ->setAlias('Attributes')
                ->setCaption('Attributes');

echo $read->render();

require 'includes/bottom.php';
