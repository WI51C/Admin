<?php

/**
 * Gets the connection of the admin system
 *
 * @return MysqliDb
 */
function get_connection()
{
    $config = require 'config.php';

    return new MysqliDb(
        $config['connection']['hostname'],
        $config['connection']['username'],
        $config['connection']['password'],
        $config['connection']['database'],
        $config['connection']['charset']
    );
}