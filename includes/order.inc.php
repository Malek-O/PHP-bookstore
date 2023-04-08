<?php
require_once "./books.inc.php";
require_once "./dbh.inc.php";
session_start();

$id = $_SESSION['u_id'];
$status = 0;
if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $total = 0;
    foreach ($cartItems as $key => $value) {
        foreach ($data as $index => $books) {
            if ($value['id'] == $books['b_id']) {
                $total += $cartItems[$key]['quantity'] * $books['b_price'];
            }
        }
    }

    $sql = "insert into orders (o_price,o_status,u_id) values(?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $total, $status, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION['cart'] = [];
    header("Location: ../index.php?error=none");
    exit();
}
exit();
