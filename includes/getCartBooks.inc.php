<?php

require_once "dbh.inc.php";

$ids = [];
$result = [];
if (count($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $key => $value) {
        array_push($ids, $value['id']);
    }
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "SELECT * FROM book WHERE b_id IN ($placeholders)";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, str_repeat('s', count($ids)), ...$ids);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }

        mysqli_stmt_close($stmt);

    }
}
