<?php

require_once "dbh.inc.php";

$url = $_SERVER['REQUEST_URI'];
if (!$url == "http: //localhost/memo/project02/order.php") {
    session_start();
}

$id = $_SESSION['u_id'];

$sql = "select * from orders where u_id = ? ;";
$stmt = mysqli_stmt_init($con);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../index.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$resultCheck = mysqli_num_rows($res);

$data = array();
if ($resultCheck > 0) {
    // Convert data into JSON format
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
}
mysqli_stmt_close($stmt);
