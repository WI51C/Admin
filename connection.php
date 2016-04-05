<?php

$config = require 'config.php';

return new MysqliDb(
    $config['connection']['hostname'],
    $config['connection']['username'],
    $config['connection']['password'],
    $config['connection']['database'],
    $config['connection']['charset']
);