<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" href="./imgs/Logo1.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Mybook</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg  navbar-dark p-4 nav-bac">
        <div class="container">
            <a class="navbar-brand" href="#"  >
                <img src="./imgs/Logo1.png" class="" width="50" height="50" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="./index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="./Books.php">Prodcuts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="./index.php">About</a>
                    </li>
                </ul>

                         <?php
if (isset($_SESSION['u_id'])) {
    echo "
                                <a class='btn btn-outline-danger me-3' href='./includes/logout.inc.php'>Logout</a>
                                <a class='btn btn-outline-success' href='order.php'>Orders</a>
                            ";
} else {
    echo "
                                <a class='btn btn-outline-primary me-3' href='./login.php'>Login</a>
                                <a class='btn btn-outline-light' href='signup.php'>Signup</a>
                            ";

}
?>

                    <div class='text-white ms-lg-4 mt-lg-0 mt-3 fs-5 cart-x'>
                        <a  class='text-white' href="./cart.php">
                            <i class="fa-solid fa-cart-shopping cart-l "></i>
                        </a>
                        <h6 id="h-cart">
                            <?php
if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $count = 0;
    foreach ($cartItems as $key => $value) {
        $count += $cartItems[$key]['quantity'];
    }
    echo $count;
} else {
    echo "0";
}

?>
                        </h6>
                    </div>
            </div>
        </div>
    </nav>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
