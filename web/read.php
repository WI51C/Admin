<?php

require '../vendor/autoload.php';

if (!array_key_exists('table', $_GET) || !array_key_exists('primary', $_GET) || !array_key_exists('identifier', $_GET)) {
    header('Location: index.php');
}

if (!validate_table($_GET['table'])) {
    header('Location: index.php');
}

$db = get_connection();
apply_join($db, $_GET['table']);
$content = $db->where($_GET['primary'], $_GET['identifier'])->get($_GET['table'], 1);

if (empty($content)) {
    header('Location: index.php');
}

require 'includes/top.php';

?>
    <div id="inner-content">
        <h2><?= sprintf('Reading record #%d from %s:', $_GET['identifier'], $_GET['table']) ?></h2>
        <ul id="reader">
            <?php foreach ($content[0] as $key => $value): ?>
                <li>
                    <div class="header"><?= $key ?></div>
                    <div class="content"><?= $value ?></div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
<?php

require 'includes/bottom.php';