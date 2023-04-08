<?php

require_once "header.php";
require_once "./includes/books.inc.php";
?>
    <div class="container-fluid  py-5 home-bac">
        <h1 class='container'>
            <span class='text-black-50'>Home</span> /
            <span> Cart</span>
        </h1>
    </div>
    <div class="container py-5 text-white">
        <div class="row text-center">
            <div class="col-lg-3">
                <h4 class='fw-normal'>Item</h4>
            </div>
            <div class="col-lg-3">
                <h4 class='fw-normal'>Price</h4>
            </div>
            <div class="col-lg-3">
                <h4 class='fw-normal'>Quantity</h4>
            </div>
            <div class="col-lg-3">
                <h4 class='fw-normal'>Subtotal</h4>
        </div>
    </div>
    <hr />

    <?php
if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $subtotal = 0;
    foreach ($cartItems as $key => $value) {
        foreach ($data as $index => $books) {
            if ($value['id'] == $books['b_id']) {
                //echo "{$books['b_id']} <br>";
                $total = $value['quantity'] * $books['b_price'];
                $subtotal += $total;
                echo "
                    <section id='cart'>
                        <div class='row text-center py-2 d-flex align-items-center gap-lg-0 gap-3'>
                            <div class='col-lg-3'>
                                <img class='img-fluid rounded w-25' src={$books['b_img']} alt='' />
                                <h6 class='text-white mt-3 '>{$books['b_name']}</h6>
                                <h6 class='text-white-50'>{$books['b_author']}</h6>
                                <button class='btn' onclick='deleteItem({$books['b_id']})'>
                                    <i class='fa-solid fa-trash-can text-danger'></i>
                                </button>
                            </div>
                            <div class='col-lg-3'>
                                <h5 class='fw-normal' id='price_{$books['b_id']}'>\${$books['b_price']}</h5>
                            </div>
                            <div class='col-lg-3'>
                                <div class='d-flex gap-3 justify-content-center'>
                                    <button class='cart-buttons fs-3' onclick='changeQuantity(-1,{$books['b_id']})'>-</button>
                                    <h6 style='margin-top: 0.5rem;' class='fs-3 fw-normal' id='quantity_{$books['b_id']}'>{$value['quantity']}</h6>
                                    <button class='cart-buttons fs-3' onclick='changeQuantity(1,{$books['b_id']})'>+</button>
                                </div>
                            </div>
                            <div class='col-lg-3'>
                                <h5 class='fw-normal' id='total_{$books['b_id']}'>\$$total</h5>
                            </div>
                        </div>
                        <hr />
                    </section>
                ";
            }
        }
    }
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "
            <div class='d-flex justify-content-center'>
                <button class='btn btn-danger w-50' onclick='deleteItem(-1)'>Clear Cart</button>
            </div>
            <div class='text-center my-5 p-5 border rounded'>
                <h4 id='subtotal'>Subtotal: \$$subtotal</h4>

    ";

    } else {
        echo "
        <h1 class='text-center'>YOUR CART IS EMPTY</h1>
    ";
    }

    if (isset($_SESSION['u_id']) && count($_SESSION['cart']) > 0) {
        echo "
             <a class='btn btn-primary mt-3' href='./includes/order.inc.php'>Confirm order</a>
            </div>
        ";
    } else if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "
             <a class='btn btn-outline-danger mt-3' href='login.php'>Login to Confirm order</a>
            </div>
        ";
    }

} else {
    echo "
        <h1 class='text-center'>YOUR CART IS EMPTY</h1>
    ";
}
?>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
        const addToCart = (id) => {
        // Send AJAX request to server to add item to cart
        const xhr = new XMLHttpRequest();
        const quantityDisplay = document.getElementById(`quantity_${id}`);
        const subtotalDisplay = document.getElementById('subtotal');
        xhr.open("POST", "./includes/addToCart.inc.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(JSON.parse(xhr.responseText));
                const cart_count = document.getElementById('h-cart');
                cart_count.innerHTML = JSON.parse(xhr.responseText).count;
                subtotalDisplay.innerHTML = 'Subtotal: $' + JSON.parse(xhr.responseText).total.toFixed(2);

            } else {
                console.error(xhr.statusText);
            }
            }
        };
        xhr.send(`id=${id}&quantity=${quantityDisplay.innerHTML}`);
        };
            const changeQuantity = (amount, id) => {
            const quantityDisplay = document.getElementById(`quantity_${id}`);
            let quantity = parseInt(quantityDisplay.innerText) + amount;
            if (quantity <= 0) {
                quantity = 1;
            }
            quantityDisplay.innerText = quantity;
            addToCart(id);

            const priceDisplay = document.getElementById(`price_${id}`);
            const price = parseFloat(priceDisplay.innerHTML.replace('$', ''));
            const totalDisplay = document.getElementById(`total_${id}`);
            let total = quantity * price;
            totalDisplay.innerHTML = '$' + total.toFixed(2);
            };

           const deleteItem = (id) => {
            $.ajax({
                url: "./includes/deleteItem.inc.php",
                type: "POST",
                data: { id: id },
                success: function () {
                    location.reload();
                },
                error: function () {
                alert("Error occurred while deleting item from cart.");
                }
            });
            }

    </script>


