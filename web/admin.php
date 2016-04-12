<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$connection = new \Admin\Connection('localhost', 'root', 'password', 'admin');
$read       = new \Admin\Read\Read($connection);
$read->table('user');
$read->caption('Users');
$read->relations->oto('image', 'image.ImageId = user.UserImage');
$read->relations->otm('attributes', 'user.UserId', 'attributes.AttributeUserId', function ($table) {
    $table->alias('Attributes');
    $table->caption('Attributes');
});

echo $read->render();

require 'includes/bottom.php';
