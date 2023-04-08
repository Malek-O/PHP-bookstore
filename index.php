<?php
require_once "header.php";
?>
    <div class="container py-5">
        <div class="row d-flex align-items-center ">
            <div class="col-lg-6 order-lg-1 order-2 text-lg-start text-center mt-lg-0 mt-5">
                 <?php
if (isset($_SESSION['u_name'])) {
    echo "
                              <h1 class='text-white'>Welcome {$_SESSION['u_name']} !</h1>
                            ";
}
?>
                <h1 style="color: #FFEEA6">Buy your favorite books</h1>
                <p class='fs-2 mt-4'  style="color: #D7D7D7">All your favorites book in one place, Buy any book, at home, on Office, or anywhere else</p>
                <a class='btn btn-light fs-2 px-4 mt-4' href="Books.php">Get Started !</a>
            </div>
            <div class="col-lg-6 order-lg-2 order-1">
                <img src="./imgs/Study.png" alt="" class='img-fluid' />
            </div>
        </div>
    </div>

<?php
require_once "footer.php";
