<?php
require_once 'init.php';

class ForgotPassword{

    public function __construct(){
        require_once 'views/forgotpassword.php';
    }
}
new ForgotPassword();