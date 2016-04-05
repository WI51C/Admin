<?php

require '../vendor/autoload.php';

$db     = get_connection();
$config = get_config();
$tables = $db
    ->where('TABLE_TYPE', 'BASE TABLE')
    ->where('TABLE_NAME', array_keys($config['tables']), 'IN')
    ->where('TABLE_SCHEMA', $config['connection']['database'])
    ->get('INFORMATION_SCHEMA.TABLES', null, ['TABLE_NAME']);


foreach ($tables['0'] as $table):
    echo "<a href='table.php?table={$table}'>{$table}</a>";
endforeach;