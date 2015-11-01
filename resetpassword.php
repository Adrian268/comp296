<?php
require_once 'init.php';

class ResetPassword{

    public function __construct(){
        require_once 'views/resetpassword.php';
    }
}

new ForgotPassword();