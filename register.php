<?php
require_once 'init.php';

class Register{

    public function __construct($data = []){
        require_once 'views/register.php';
    }
}


// check for error messages
if(isset($_SESSION['error_message']))
    $er_msg = $_SESSION['error_message'];

// check if a session has been started to restrict navigating register.php while logged in
Auth::check();

new Register();