<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "bookstore";
$con = mysqli_connect($server, $user, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
