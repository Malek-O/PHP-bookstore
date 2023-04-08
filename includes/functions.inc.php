<?php

function emptyInputSginIp($email, $username, $pwd, $rpwd)
{
    $result = "";
    if (empty($email) || empty($username) || empty($pwd) || empty($rpwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($username)
{
    $result = "";
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $rpwd)
{
    $result = "";
    if ($pwd !== $rpwd) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($con, $username, $email)
{
    $result = "";

    $sql = "select * from users where u_name = ? OR u_email = ?;";
    // create a prepared statment
    $stmt = mysqli_stmt_init($con);
    // prepare the prepared statment
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    } else {
        // Bind parameters to placeholder
        mysqli_stmt_bind_param($stmt, "ss", $username, $email); // if we have multiple ???? just add more ssss
        // Run paramenters inside the database
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($res)) {
            $result = $row;
            return $result;
        } else {
            $result = false;
            return $result;
        }
    }
    mysqli_stmt_close($stmt);
}

function createUser($con, $email, $username, $pwd)
{

    $sql = "insert into users (u_name,u_email,u_pwd) values(?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    // hashing the password
    $hashedPWd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPWd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd)
{
    $result = "";
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;

    }
    return $result;
}

function loginUser($con, $username, $pwd)
{

    $uidExists = uidExists($con, $username, $username);

    if (!$uidExists) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    $pwsHashed = $uidExists['u_pwd'];
    $dehshing = password_verify($pwd, $pwsHashed);

    if (!$dehshing) {
        header("Location: ../login.php?error=wrongpass");
        exit();
    } else {
        session_start();
        $_SESSION["u_id"] = $uidExists['u_id'];
        $_SESSION["u_name"] = $uidExists['u_name'];
        header("Location: ../index.php");
        exit();
    }

}
