<?php

require '../vendor/autoload.php';

$db     = get_connection();
$config = get_config();
$tables = $db
    ->where('TABLE_TYPE', 'BASE TABLE')
    ->where('TABLE_NAME', array_keys($config['tables']), 'IN')
    ->where('TABLE_SCHEMA', $config['connection']['database'])
    ->get('INFORMATION_SCHEMA.TABLES', null, ['TABLE_NAME']);

require 'pages/top.php';
?>
    <ul>
        <?php
        foreach ($tables['0'] as $table):
            ?>
            <li>
                <a href="table.php?table=<?= $table ?>">
                    <?= array_key_exists('alias', $config['tables'][$table]) ? $config['tables'][$table]['alias'] : $table ?>
                </a>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
<?php
require 'pages/bottom.php';