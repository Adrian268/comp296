<?php
require_once 'Util/View.php';
require 'Util/Auth.php';

if(isset($_SESSION['error_message']))
    $er_msg = $_SESSION['error_message'];

Auth::check();

require_once 'Templates/html_head.php';
require_once 'Templates/page_header.php';

?>
<section>
        <?php if(isset($er_msg)) {
            echo "<div class='flash-message error'>{$er_msg}</div>";
        }?>

            <div class="input-container">
            <form method="POST" action="controllers/RegisterController.php" id="RegisterForm">
                    <div class="input-wrapper">
                        <input type="text" placeholder="NAME" name="name" id="name" class="text-input focus" minlength="3" required>
                       <input type="email" placeholder="EMAIL" name="email" id="email" class="text-input"  required>
                        <input type="tel" placeholder="PHONE NUMBER" id="phone" name="phone" class="text-input">
                        <input type="password" placeholder="PASSWORD" name="password" id="password" class="text-input" required minlength="6">
                        <input type="password" placeholder="CONFIRM PASSWORD" name="password_confirm" id="password_confirm" class="text-input" required minlength="6">
                        <input type="submit" value="REGISTER" name="register_rqst">
                        <p>Already have an account? <a href="index.php">LOG IN</a></p>
                    </div>
            </form>
            </div>
</section>


<script>
    $('#RegisterForm').validate({
        rules:{
            name:{
                letterswithbasicpunc: true
            },
            password:{
                alphanumeric: true
            },
            password_confirm:{
                equalTo: "#password"
            },
            phone:{
                phoneUS: true
            },
            email:{
                remote: "util/validate_email.php"
            }
        },
        messages:{
            password_confirm:{
                equalTo: "Passwords do not match."
            },
            email:{
                remote: "Sorry. this email already exists"
            }
        },
        errorPlacement: function(error, element) {
            error.insertBefore(element);
        }
    });
</script>

<?php require_once 'Templates/html_footer.php' ?>
