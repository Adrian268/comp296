<?php

$page = 'index';

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

    <div class="background-img"></div>

        <div class="input-container login-form-container">
        <form method="POST" action="controllers/LoginController.php">
                <div class="input-wrapper">
                    <input type="text" placeholder="EMAIL" name="email" id="email" class="text-input email focus" >
                    <input type="password" placeholder="PASSWORD" name="password" class="text-input">
                    <input type="submit" value="LOG IN" name="log_in">
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                    <p><a href="forgotpassword.php">Forgot Password?</a></p>
                </div>
        </form>
        </div>

    <div class="about-sections">
        <div class="container">
            <div id="store-online">
                <p >Create and store your lists online</p>
            </div>
            <div id="device-range">
                <p>Accessible from any web enabled device</p>
            </div>
            <div id="share-with-fnf">
                <p >Share lists with family and friends</p>
            </div>
        </div>
    </div>
</section>


<?php require_once 'templates/html_footer.php' ?>
