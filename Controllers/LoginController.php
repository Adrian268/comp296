<?php
require_once '../Util/Auth.php';
require_once '../Util/Session.php';
require_once '../Util/View.php';

class LoginHandle {

    protected $ER_MSG = 'Invalid EMAIL or PASSWORD. Try again';

    function __construct(){

        if(isset($_POST['log_in'])) {
            $this->login(trim($_POST['email']), trim($_POST['password']));
        }
        else if (isset($_GET['log_out'])) {
            $this->logOut();
        }

    }

    function login($email, $password){

        if (Auth::attempt($email, $password)) {
                View::render('dashboard.php');

        } else {
            $_SESSION['error_message'] = $this->ER_MSG;
            View::render('index.php');
        }

    }

    function logOut(){
        Auth::logout();
        View::render('index.php');
    }

}

$login = new LoginHandle();





