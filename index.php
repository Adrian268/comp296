<?php
//require_once 'Util/Session.php';
require_once 'Util/View.php';

//$email = unserialize($_SESSION['encoded_vartopass']);

//echo $email;

if (Session::error()){
    $er_msg = $_SESSION['error_message'];
    Session::clear();
}
else if(Session::isLoggedIn()){
    View::render('user/profile.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>List App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link rel="stylesheet" href="Assets/bower_components/bootstrap/dist/css/bootstrap.min.css">-->
    <script src="Assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="Assets/js/init.js"></script>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>
<div class="top-heading">
    <div id="logo-link-container">
        <div id="logo"><a href="index.php">
                <p>ListApp</p></a></div>
        <div id="top-right"><a href="index.php">SIGN IN</a> |<a href="register.php"> REGISTER</a></div>
    </div>
</div>
<div id="main-body">
    <?php if(isset($er_msg)) {
        echo "<div class='flash-message error'> $er_msg </div>";
    }?>
    <!--.confirm-message Your Password has been reset-->
    <section>
        <form method="POST" action="Controllers/LoginController.php">
            <div class="input-container">
                <div class="input-wrapper">
                    <input type="text" placeholder="EMAIL" name="email" id="focus" class="text-input email" >
                    <input type="password" placeholder="PASSWORD" name="password" class="text-input">
                    <input type="submit" value="Log In" name="log_in">
                    <p>Don't have an account? <a href="register.php">REGISTER</a></p>
                    <p><a href="#">Forgot Password?</a></p>
                </div>
            </div>
        </form>
        <!--.promo-->
    </section>
</div>
<footer>
    <p>&copy;2015 ListApp</p>
</footer>
</body>
</html>

