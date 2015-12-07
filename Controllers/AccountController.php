<?php
require_once '../util/database.php';
require_once '../models/User.php';
require_once '../util/Auth.php';

if(isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $user = new User();

    if(isset($_POST['edit_account_info'])){

        $name = ucwords(strtolower(trim($_POST['new_name'])));
        $email = strtolower(trim($_POST['new_email']));

        $user->update($name, $email, $user_id);

        echo json_encode([
            'name' => $name,
            'email' => $email,
        ]);


    }

    if(isset($_POST['change_password_rqst'])){

        if($_POST['new_password'] !== ""){

            if(strlen($_POST['new_password']) > 6 ){

                if($_POST['new_password'] === $_POST['new_password_cf']){

                    $password = password_hash(trim($_POST['new_password']), PASSWORD_BCRYPT);
                    $email = $_POST['email'];

                    $user->resetPassword($password, $email, $user_id);

                    echo "true";

                }else{

                    echo "Passwords do not match.";
                }

            }else{
                echo "Password has to be more than six characters";
            }


        }else{
            echo "Password field can not be empty";
        }

    }

    if(isset($_POST['delete_account_rqst'])){

        $password = $_POST['confirm_password'];
        $email = $_SESSION['email'];

        if (Auth::attempt($email, $password)) {

            $user->delete($email, $user_id);
            Auth::logout();
            session_start();
            $_SESSION['error_message'] = "Your account has been deleted.";
            echo "true";


        } else {

            echo "Wrong Password";
        }

    }


}