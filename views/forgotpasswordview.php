<?php

require 'Templates/html_head.php';
require 'Templates/page_header.php';

?>

<section>
    <?php if(isset($er_msg)) {
        echo "<div class='flash-message error'>{$er_msg}</div>";
    }?>

    <div class="background-img"></div>

    <form method="POST" action="controllers/PasswordController.php" >
        <div class="input-container">
            <div class="input-wrapper">
                <p>Can't remember your password?</p>
                <input type="email" placeholder="EMAIL" name="email" class="text-input focus" required>
                <input type="submit" value="SEND PASSWORD RESET LINK" name="password_reset_email_rqst">
            </div>
        </div>
    </form>

    <?php require_once'templates/aboutsections.html' ?>

</section>


<?php require_once 'Templates/html_footer.html' ?>