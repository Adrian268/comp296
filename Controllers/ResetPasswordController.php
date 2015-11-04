<?php
require_once '../Util/Database.php';
require_once '../Util/View.php';
require_once '../Models/UserModel.php';
require_once 'LoginController.php';
require_once '../Models/PasswordReset.php';

$message = [
    "PasswordReset" => "Your password has been reset",
    "PasswordNoMatch" => "Passwords do not match",
    "EmailNoMatch" => "Email does not match"
];

$token = $_POST['token'];
$email = trim(strtolower($_POST['email']));
$new_password = trim($_POST['new_password']);
$new_password_cf = trim($_POST['new_password_cf']);

$db = new Database();

$query = $db->query("SElECT * FROM password_resets where email = '$email' AND token = '$token'");
$data = $query->fetch(PDO::FETCH_ASSOC);


    if ($data['email'] === $email) {

        if($new_password === $new_password_cf){

            $password = password_hash($new_password, PASSWORD_BCRYPT);
            $user = new User();
            $user->resetPassword($password, $email);

            $db->query("DELETE FROM password_resets where token = '$token'");

            $_SESSION['confirm_message'] = $message['PasswordReset'];

            $login->login($email, $new_password);

        }else {

            $_SESSION['error_message'] = $message['PasswordNoMatch'];
            View::render("resetpassword.php?token=$token");
        }

    } else {

        $_SESSION['error_message'] = $message['EmailNoMatch'];
        View::render("resetpassword.php?token=$token");
    }




