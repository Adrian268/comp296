<?php
require_once 'init.php';
require_once 'util/token.php';

class ResetPassword{
    
    public function __construct(){
        $page = 'resetpassword';

        //check for error messages
        if(isset($_SESSION['error_message']))
            $er_msg = $_SESSION['error_message'];

        // check if a session has been started to restrict navigation to resetpassword.php while logged in
        Auth::check();

        // validate token
        if(isset($_GET['token'])){
            session_start();
            Token::validateToken($_GET['token']);
        }

        require_once 'views/resetpassword.php';
    }
}


new ResetPassword();