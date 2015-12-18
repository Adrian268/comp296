<?php
require_once 'init.php';

class Register{

    public function __construct(){
        $page = 'register';

        // check for error messages
        if(isset($_SESSION['error_message']))
            $er_msg = $_SESSION['error_message'];

        // check if a session has been started to restrict navigating register.php while logged in
        Auth::check();

        require_once 'views/registerview.php';
    }
}

new Register();