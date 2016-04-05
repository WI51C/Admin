<?php
//session_start();
//
//if (!isset($_SESSION['admin'])) {
//    header('location: login.php');
//}
?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/admin.css" media="screen,projection"/>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<div class="row">
    <div id="menu" class="col s2">
        <div class="logoarea">
            <h1><?= get_config()['header'] ?></h1>
            <p>Admin Control Panel</p>
        </div>
        <ul>
            <?php foreach (get_tables() as $id => $table): ?>
                <li class="hoverable">
                    <a class="waves-effect waves-light" href="table.php?table=<?= $id ?>"><?= $table ?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <div id="content" class="col s10 offset-s2">
        <div id="inner-content">