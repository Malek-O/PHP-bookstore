<?php
session_start();
$id = $_POST['id'];

$existing_cart = $_SESSION['cart'];

if ($id == -1) {
    $_SESSION['cart'] = [];
} else {

    foreach ($existing_cart as $key => $item) {
        if ($item['id'] == $id) {
            unset($existing_cart[$key]);
            break;
        }
    }
    $_SESSION['cart'] = $existing_cart;
}
