<?php

require_once "header.php";
require_once "./includes/books.inc.php";
?>

    <div class="container-fluid  py-5 home-bac">
        <h1 class='container'>
            <span class='text-black-50'>Home</span> /
            <span> Products</span>
        </h1>
    </div>
    <div class="container">
        <div class="row d-flex ">
        <?php
foreach ($data as $value) {
    echo "
            <div class='col-lg-3 col-md-6 d-flex flex-column align-items-lg-start align-items-center  py-5'>
                <img class='img-fluid rounded w-50' src={$value['b_img']} alt='' />
                <h6 class='text-white mt-3 w-75 text-lg-start text-center'>{$value['b_name']}</h6>
                <h6 class='text-white-50'>{$value['b_author']} </h6>
                <p class='text-white'>\${$value['b_price']}</p>
                <div class='d-flex bg-light  p-2 rounded'>
                    <button class='btn btn-success me-2' onclick='addToCart({$value['b_id']})'>Add to Cart</button>
                    <div class='d-flex  align-items-center gap-2'>
                        <button class='cart-buttons' onclick='changeQuantity(-1,{$value['b_id']})'>-</button>
                        <h6 style='margin-top: 0.5rem' id='quantity_{$value['b_id']}' >1</h6>
                        <button class='cart-buttons' onclick='changeQuantity(1,{$value['b_id']})'>+</button>
                    </div>
                </div>
            </div>
        ";
}

?>


        </div>
    </div>
    <script>
        const addToCart = (id) => {
        // Send AJAX request to server to add item to cart
        const xhr = new XMLHttpRequest();
        const quantityDisplay = document.getElementById(`quantity_${id}`);
        xhr.open("POST", "./includes/addToCart.inc.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const cart_count = document.getElementById('h-cart');
                cart_count.innerHTML = JSON.parse(xhr.responseText).count;
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
            if (quantity < 0) {
                quantity = 0;
            }
            quantityDisplay.innerText = quantity;
            };
    </script>
<?php
require_once "footer.php";
