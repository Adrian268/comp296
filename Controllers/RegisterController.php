<?php
require_once '../Models/UserModel.php';
//require_once '../Util/View.php';
//require_once '../Util/Connection.php';
require_once 'LoginController.php';

if(isset($_POST['register_rqst'])) {

    if($_POST['password'] == $_POST['password_confirm']){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_BCRYPT);

        $user = new User($name, $email, $phone_number, $password);
        $user->save();

        new Session();

        $login->tryLogin($email, $password, $db_connection);
    }else{
        new Session();
        Session::setError("Passwords no not match");
        View::render('../register.php');
    }
}
