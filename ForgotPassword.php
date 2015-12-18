<?php
require_once 'init.php';

class ForgotPassword{

    public function __construct(){
        $page = 'forgotpassword';

        // check for error messages
        if(isset($_SESSION['error_message']))
            $er_msg = $_SESSION['error_message'];

        // check if a session has been started to restrict navigation to forgotpassword.php while logged in
        if(!Auth::check())
            require_once 'views/forgotpasswordview.php';
    }
}

new ForgotPassword();