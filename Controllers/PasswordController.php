<?php
require_once '../Util/Database.php';
require_once '../Util/View.php';
require_once '../Util/Session.php';
require_once '../Models/PasswordReset.php';


    $CF_MSG = "An email has been sent. Please follow the link to reset your password";
    $ERR_MSG = "There is no account by that email";

    $email = trim($_POST['email']);

    $db = new Database();

    $query = $db->query("SElECT email FROM USERS where email = '$email' ");
    $data = $query->fetch(PDO::FETCH_ASSOC);


    if ($data['email'] === $email) {

        $password = new PasswordReset;

        if($password->sendPasswordLink($email)){

            $_SESSION['confirm_message'] = $CF_MSG;
            View::render('index.php');

        }else{

            $_SESSION['error_message'] = "Unable to process the request. Please try again later.";
            View::render('forgotpassword.php');
        }

    } else {

        $_SESSION['error_message'] = $ERR_MSG;
        View::render('forgotpassword.php');
    }








