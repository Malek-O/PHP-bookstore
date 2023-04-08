<?php

if (isset($_POST['submit'])) {

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    if (emptyInputLogin($username, $pwd) !== false) {
        header("Location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($con, $username, $pwd);

} else {
    header("Location: ../login.php");
    exit();
}
