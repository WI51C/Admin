<?php
ob_start();
session_start();

$username = $_POST['username'] ?? 'error';
$password = $_POST['password'] ?? 'error';
$admin    = $_SESSION['admin'] ?? 0;
$_SESSION['error'] = $_SESSION['error'] ?? 0;

if ($_POST ?? FALSE) {
    $user = new Crud\User();
$user->getData();

    foreach ($user as $u) {
        if($u['UserName'] == $username){
            if(password_verify($password, $u['UserPassword']))
                $_SESSION['admin'] = 1;
            else
                $_SESSION['error'] = 1;
        }
    }

}

//Redirects admin if he is logged in.
if ($admin == 1) {
    header('location: index.php');
    exit;
}
//Fixes reload. Problem caused by POST.
if (isset($_POST['login'])) {
    header('location: ' . $_SERVER['PHP_SELF']);
    exit;
}
ob_end_flush();

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
<style>
    body {
        background: #2f2f2f;
    }
</style>
<div class="row login-outer">
    <div class="col s4 offset-s4 login-inner">
        <div class="row">
            <form action="" method="post">
                <div class="col s12">

                    <!-- username input-->
                    <div class="input-field">
                        <i class="material-icons prefix">person</i>
                        <input id="username" type="text" class="validate" name="username">
                        <label for="username">Username</label>
                    </div>
                    <!-- Password input -->
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" type="password" class="validate" name="password">
                        <label for="password">Password</label>
                    </div>

                </div>
                <div class="col s6 offset-s3">
                    <input class="btn waves-effect waves-light" type="submit" name="login" value="Log ind">
                </div>

            </form>
        </div>
    </div>
    <div class="col s4"></div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/bin/materialize.min.js"></script>
    <script> $(document).ready(function () {
            $('input#input_text, textarea#textarea1').characterCounter();
        });
    </script>
    <?php if ($_SESSION['error'] == 1) {
        $_SESSION['error'] = 0;
        ?>
        <script>Materialize.toast('Forkert Brugernavn/Kodeord', 4000)</script>
    <?php } ?>
</div>
</body>
</html>