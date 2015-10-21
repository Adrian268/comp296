<?php
//require_once 'Util/Session.php';
require_once 'Util/View.php';

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
    <link rel="stylesheet" href="Assets/css/style.css">
    <script src="Assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="Assets/js/init.js"></script>
</head>
<body>
<div class="top-heading">
    <div id="logo-link-container">
        <div id="logo"><a href="#">
                <p>ListApp</p></a></div>
        <div id="top-right"><a href="index.php">LOG IN</a> |<a href="register.php"> REGISTER</a></div>
    </div>
</div>
<div id="main-body">
    <?php if(isset($er_msg)) {
        echo "<div class='flash-message error '> $er_msg </div>";
    }?>
    <!--.error-message This email doesn't exist. Try again-->
    <!--.confirm-message Your Password has been reset-->
    <section>
        <form method="POST" action="Controllers/RegisterController.php">
            <div class="input-container">
                <div class="input-wrapper">
                    <input type="text" placeholder="NAME" name="name" id="focus" class="text-input" required>
                    <input type="text" placeholder="EMAIL" name="email" class="text-input" required>
                    <input type="text" placeholder="PHONE NUMBER" name="phone_number" class="text-input">
                    <input type="password" placeholder="PASSWORD" name="password" class="text-input" required>
                    <input type="password" placeholder="CONFIRM PASSWORD" name="password_confirm" class="text-input" required>
                    <input type="submit" value="REGISTER" name="register_rqst">
                    <p>Already have an account? <a href="index.php">LOG IN</a></p>
                </div>
            </div>
        </form>
    </section>
</div>
<footer>
    <p>&copy;2015 ListApp</p>
</footer>
</body>
</html>