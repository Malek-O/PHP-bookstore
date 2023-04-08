<?php

include_once 'header.php';
?>

   <section class="container text-white my-5 log-w p-5 rounded" >
        <h2>Login</h2>
        <form action="./includes/login.inc.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username/email</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="uid">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
        <h4 class="text-center mt-3">
 <?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinput") {
        echo "<p>Fill in all fileds!</p>";
    } elseif ($_GET['error'] == "wronglogin") {
        echo "<p>Check your Username/email</p>";
    } elseif ($_GET['error'] == "wrongpass") {
        echo "<p>Check your password</p>";
    }
}

?>
</h4>
   </section>

<?php
include_once 'footer.php';
