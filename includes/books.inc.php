<?php

require_once "dbh.inc.php";

$sql = "SELECT * FROM book";
$result = mysqli_query($con, $sql);
$resultCheck = mysqli_num_rows($result);
$data = array();
if ($resultCheck > 0) {
    // Convert data into JSON format
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
