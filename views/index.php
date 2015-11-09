<?php

require 'Templates/html_head.php';
require 'Templates/page_header.php';

?>

<section>
    <?php if(isset($er_msg)) {
        echo "<div class='flash-message error'>{$er_msg}</div>";
    }?>

    <?php if(isset($cf_msg)) {
        echo "<div class='flash-message confirm remove'>{$cf_msg}</div>";
    }?>

        <div class="input-container">
        <form method="POST" action="controllers/LoginController.php">
                <div class="input-wrapper">
                    <input type="text" placeholder="EMAIL" name="email" id="email" class="text-input email focus" >
                    <input type="password" placeholder="PASSWORD" name="password" class="text-input">
                    <input type="submit" value="Log In" name="log_in">
                    <p>Don't have an account? <a href="register.php">REGISTER</a></p>
                    <p><a href="forgotpassword.php">Forgot Password?</a></p>
                </div>
        </form>
        </div>
</section>


<?php require_once 'templates/html_footer.php' ?>
