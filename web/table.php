<?php

require '../vendor/autoload.php';

if (isset($_GET['table']))
    $table = $_GET['table'];

else
    header('location: index.php');

$db     = get_connection();
$config = get_config();

$info = $config['tables'][ $table ]['input'];
$data = $db->get($table);
$info = array_filter($info, function ($value) {
    return !(array_key_exists('hidden', $value) && $value['hidden'] === TRUE);
});
?>

<table>
    <caption><?= $table ?></caption>
    <thead>
    <tr>
        <?php
        var_dump($info);
        foreach ($info as $key => $item) { ?>
            <th><?= $item['alias'] ?? $key ?? null ?></th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>data</td>
    </tr>
    </tbody>
</table>
