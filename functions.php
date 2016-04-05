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
        $config['connection']['database']
    );
}

/**
 * Gets the config array of the admin system
 *
 * @return array
 */
function get_config()
{
    return include('config.php');
}

/**
 * Displays a php file.
 *
 * @param string $page
 */
function display_content(string $page)
{
    require 'pages/top.php';
    require $page;
    require 'pages/bottom.php';
}

/**
 * Gets all tables to display
 *
 * @return array
 */
function get_tables()
{
    $db     = get_connection();
    $config = get_config();
    $tables = [];

    foreach ($db
                 ->where('TABLE_TYPE', 'BASE TABLE')
                 ->where('TABLE_NAME', array_keys($config['tables']), 'IN')
                 ->where('TABLE_SCHEMA', $config['connection']['database'])
                 ->get('INFORMATION_SCHEMA.TABLES', null, ['TABLE_NAME'])
             as $table) {
        $table = $table['TABLE_NAME'];
        if (array_key_exists($table, $config['tables'])) {
            $tables[$table] = array_key_exists('alias', $config['tables'][$table]) ? $config['tables'][$table]['alias'] : $table;
        }
    }

    return $tables;
}

function apply_join(MysqliDb $db, string $table)
{
    $config = get_config();
    $joins  = array_key_exists('joins', $config['tables'][$table]) ? $config['tables'][$table]['joins'] : [];
    foreach ($joins as $join) {
        call_user_func_array([$db, 'join'], $join);
    }

    return $db;
}


function merge_join_inputs(string $table)
{
    $config = get_config();
    $joins  = array_key_exists('joins', $config['tables'][$table]) ? $config['tables'][$table]['joins'] : [];
    $tables = array_map(function ($value) {
        return $value[0];
    }, $joins);

    $combined = $config['tables'][$table];
    foreach ($tables as $table) {
        $combined = array_merge($config['tables'][$table]['inputs']);
    }

    return array_filter($combined, function ($value) {
        return !(array_key_exists('hidden', $value) && $value['hidden'] === true);
    });
}

/**
 * Checks if a table can be shown
 *
 * @param string $table
 *
 * @return bool
 */
function validate_table(string $table)
{
    return array_key_exists($table, get_config()['tables']);
}