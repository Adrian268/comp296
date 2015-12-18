<?php
require_once '../Models/User.php';
require_once 'LoginController.php';

if(isset($_POST['register_rqst'])) {

    if($_POST['password'] === $_POST['password_confirm']){

        $name = ucwords(strtolower(trim($_POST['name'])));
        $email = trim($_POST['email']);
        $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : null;
        $password = trim($_POST['password']);

        $email = strtolower($email);

        $password = password_hash($password, PASSWORD_BCRYPT);

        $user = new User();

        if($user->save($name, $email, $phone_number, $password)){
            if($user->createUserDir($email))
                $login->login(trim($_POST['email']), trim($_POST['password']));
        }else{
            $_SESSION['error_message'] = "Sorry! An error occurred, please try again.";
            View::render('register.php');
        }

    }else{

        $_SESSION['error_message'] = "Passwords no not match";
        View::render('register.php');
    }
}
