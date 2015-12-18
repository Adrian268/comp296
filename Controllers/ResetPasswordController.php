<?php
require_once '../Util/Database.php';
require_once '../Util/View.php';
require_once '../Models/User.php';
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
            $user = new User();

            $query = $db->query("SELECT user_id from users where email = '$email'");
            $user_id_query  = $query->fetch(PDO::FETCH_ASSOC);
            $user_id = $user_id_query['user_id'];

            $password = password_hash($new_password, PASSWORD_BCRYPT);

            $user->resetPassword($password, $email, $user_id);

            echo $password . "<br/>";
            echo $user_id. "<br/>";
            echo $email. "<br/>";

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




