<?php
require_once 'init.php';

class ForgotPassword{

    public function __construct(){

        // check for error messages
        if(isset($_SESSION['error_message']))
            $er_msg = $_SESSION['error_message'];

        // check if a session has been started to restrict navigation to forgotpassword.php while logged in
        Auth::check();

        require_once 'views/forgotpassword.php';
    }
}
new ForgotPassword();