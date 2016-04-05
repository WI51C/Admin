<?php

require '../vendor/autoload.php';

if (!array_key_exists('table', $_GET) || !array_key_exists('primary', $_GET) || !array_key_exists('identifier', $_GET)) {
    header('Location: index.php');
}

$db      = get_connection();
$content = $db->where($_GET['primary'], $_GET['identifier'])->get($_GET['table'], 1);

if (empty($content)) {
    header('Location: index.php');
}

require 'includes/top.php';

?>
    <ul>
        <?php foreach ($content[0] as $key => $value): ?>
            <li>
                <div><?= $key ?></div>
                <div><?= $value ?></div>
            </li>
        <?php endforeach ?>
    </ul>
<?php

require 'includes/bottom.php';