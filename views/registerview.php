<?php

require_once 'Templates/html_head.php';
require_once 'Templates/page_header.php';

?>

<section>
    <?php if(isset($er_msg)) {
        echo "<div class='flash-message error'>{$er_msg}</div>";
    }?>

    <div class="background-img"></div>

    <div class="input-container">
        <form method="POST" action="controllers/registercontroller.php" id="RegisterForm">
            <div class="input-wrapper">
                <input type="text" placeholder="NAME" name="name" id="name" class="text-input focus" minlength="3" required>
                <input type="email" placeholder="EMAIL" name="email" id="email" class="text-input"  required>
                <input type="password" placeholder="PASSWORD" name="password" id="password" class="text-input" required minlength="6">
                <input type="password" placeholder="CONFIRM PASSWORD" name="password_confirm" id="password_confirm" class="text-input" required minlength="6">
                <input type="submit" value="REGISTER" name="register_rqst">
                <p>Already have an account? <a href="index.php">Log In</a></p>
            </div>
        </form>
    </div>

    <?php require_once'templates/aboutsections.html' ?>

</section>

<script  type="text/javascript" src="assets/js/registervalidation.js"></script>

<?php require_once 'Templates/html_footer.html' ?>
