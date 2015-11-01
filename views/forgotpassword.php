<?php
require_once 'Util/View.php';
require_once 'Util/Auth.php';

if(isset($_SESSION['error_message']))
    $er_msg = $_SESSION['error_message'];

Auth::check();

require 'Templates/html_head.php';
require 'Templates/page_header.php';
?>

<section>
    <?php if(isset($er_msg)) {
        echo "<div class='flash-message error'>{$er_msg}</div>";
    }?>

    <form method="POST" action="../controllers/PasswordController.php" >
        <div class="input-container">
            <div class="input-wrapper">
                <p>Can't remember your password?</p>
                <input type="email" placeholder="EMAIL" name="email" class="text-input focus" required>
                <input type="submit" value="Send Password Reset Link" name="password_reset_email_rqst">
            </div>
        </div>
    </form>
</section>


<?php require_once 'Templates/html_footer.php' ?>