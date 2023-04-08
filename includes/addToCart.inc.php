<?php

session_start();
require_once "./books.inc.php";

$id = $_POST['id'];
$quantity = $_POST['quantity'];
$total = 0.0;

if ($quantity > 0) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [
            array('id' => $id, 'quantity' => $quantity),
        ];
    } else {
        $existing_cart = $_SESSION['cart'];
        $new_item = array(
            array('id' => $id, 'quantity' => $quantity),
        );
        $flag = true;
        foreach ($existing_cart as $key => $value) {
            if ($value['id'] == $id) {
                $existing_cart[$key]['quantity'] = $quantity;
                $flag = false;
                //print_r($existing_cart[$key]['quantity']);
                $_SESSION['cart'] = $existing_cart;
            }
        }
        if ($flag) {
            $updated_objects = array_merge($existing_cart, $new_item);
            $_SESSION['cart'] = $updated_objects;
        }
    }
}

/* echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>"; */

if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $count = 0;
    foreach ($cartItems as $key => $value) {
        $count += $cartItems[$key]['quantity'];
    }
    foreach ($cartItems as $key => $value) {
        foreach ($data as $index => $books) {
            if ($value['id'] == $books['b_id']) {
                $total += $cartItems[$key]['quantity'] * $books['b_price'];
            }
        }

    }
    echo json_encode(["count" => $count, "total" => $total]);

}
exit();
