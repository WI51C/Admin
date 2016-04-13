<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$connection = new \Admin\Connection('localhost', 'root', 'password', 'admin');
$read       = new \Admin\Read\Read($connection);
$read->table('user');
$read->caption('USERS');
$read->relations->oto('image', 'image.ImageId = user.UserImage');
$read->relations->otm('attributes', 'user.UserId', 'attributes.AttributeUserId', function ($table) {
    $table->alias('Attributes');
    $table->caption('Attributes');
    $table->relations->otm('SomeRelation', 'attributes.Some', 'somerelation.SomeRelationFK', function ($table) {
        $table->table('SomeRelation');
        $table->caption('SomeRelation');
    });
});

echo $read->render();

require 'includes/bottom.php';
