<?php

require '../vendor/autoload.php';

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