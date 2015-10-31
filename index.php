<?php
require_once 'Util/View.php';
require_once 'Util/Auth.php';

if(isset($_SESSION['error_message']))
    $er_msg = $_SESSION['error_message'];

if(isset($_SESSION['confirm_message']))
    $cf_msg = $_SESSION['confirm_message'];

Auth::check();

require 'Templates/html_head.php';
require 'Templates/page_header.php';
?>

<div id="main-body">
    <?php if(isset($er_msg)) {
        echo "<div class='flash-message error'>{$er_msg}</div>";
    }?>

    <?php if(isset($cf_msg)) {
        echo "<div class='flash-message confirm'>{$cf_msg}</div>";
    }?>
    <section>
        <div class="input-container">
        <form method="POST" action="controllers/LoginController.php">
                <div class="input-wrapper">
                    <input type="text" placeholder="EMAIL" name="email" id="email" class="text-input email focus" >
                    <input type="password" placeholder="PASSWORD" name="password" class="text-input">
                    <input type="submit" value="Log In" name="log_in">
                    <p>Don't have an account? <a href="register.php">REGISTER</a></p>
                    <p><a href="password.php">Forgot Password?</a></p>
                </div>
        </form>
        </div>
    </section>
</div>

<?php require_once 'Templates/html_footer.php' ?>
