<?php

require 'Templates/html_head.php';
require 'Templates/page_header.php';

?>
    <section>
        <?php if(isset($er_msg)) {
            echo "<div class='flash-message error'>{$er_msg}</div>";
        }?>

        <div class="background-img"></div>

        <div class="input-container">
        <form method="POST" action="Controllers/ResetPasswordController.php" id="ResetPasswordForm">

            <div class="input-wrapper">
            <p>Confirm your email and set your new password.</p>
            <div>
            <input type="email" placeholder="EMAIL" name="email" id="email" class="text-input focus" required/>
            <input type="password" placeholder="NEW PASSWORD" name="new_password" id="new_password" class="text-input" minlength="6" required>
            <input type="password" placeholder="CONFIRM NEW PASSWORD" name="new_password_cf" id="new_password_cf" class="text-input" minlength="6" required>
            <input type="hidden" name="token" value="<?php if(isset($_GET['token'])) echo $_GET['token']?>">
            <input type="submit" value="RESET PASSWORD" name="reset_password_rqst">
            </div>
          </div>
        </form>
        </div>
    </section>

    <script>
        $('#ResetPasswordForm').validate({
            rules:{
                new_password_cf:{
                    equalTo: "#new_password"
                }
            },
            messages:{
                new_password_cf:{
                    equalTo: "Passwords do not match."
                }
            },
            errorPlacement: function(error, element) {
                error.insertBefore(element);
            }
        });

    </script>
<?php require_once 'Templates/html_footer.php' ?>