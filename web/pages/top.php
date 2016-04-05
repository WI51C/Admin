<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="row">
    <nav class="col s2">
        <ul>
            <?php foreach (get_tables() as $table => $display): ?>
                <li>
                    <a href="table.php?table=<?= $table ?>">
                        <?= $display ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <main class="col s10">