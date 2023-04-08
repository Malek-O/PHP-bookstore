
<?php

include_once 'header.php';
?>

   <section class="container text-white log-w my-5 p-5  rounded" >
        <h2>Sign Up</h2>
        <form action="./includes/signup.inc.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="uid">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pwdrepeat">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Sign up</button>
        </form>

        <h4 class="text-center mt-3">
 <?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinput") {
        echo "<p>Fill in all fileds!</p>";
    } elseif ($_GET['error'] == "invaliduid") {
        echo "<p>Username should inculde only letters OR letters and numbers</p>";
    } elseif ($_GET['error'] == "pwdmismatch") {
        echo "<p>Make sure you repeated the password correctly!</p>";
    } elseif ($_GET['error'] == "usernametaken") {
        echo "<p>Username or E-mail is already taken choose another one 😢</p>";
    } elseif ($_GET['error'] == "stmtfaild") {
        echo "<p>Something went wrong try again 😢</p>";
    } elseif ($_GET['error'] == "invalidemail") {
        echo "<p>Please Enter a valid email !</p>";
    } elseif ($_GET['error'] == "none") {
        echo "<p>Welcome aboared 😊</p>";
    }

}

?>
</h4>

   </section>



<?php
include_once 'footer.php';
