<?php

require '../vendor/autoload.php';
require 'includes/top.php';

$connection = new \Admin\Connection('localhost', 'root', 'password', 'admin');
$read       = new \Admin\Read\Read($connection);
$read->table('user');
$read->caption('Users');
$read->relations->oto('image', 'ImageId = UserImage');
$read->relations->otm('attributes', 'UserId', 'AttributeUserId', function ($table) {
    $table->alias('Attributes');
    $table->columns(['AttributeText' => 'Attributes']);
    $table->alias('Attributes');
});

echo $read->render();

require 'includes/bottom.php';
