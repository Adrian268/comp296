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

            $dirs = ["../users/".$user_id."/img", "../users/".$user_id];

            if(file_exists($dirs[0]."/profilepic.jpg"))
                unlink($dirs[0]."/profilepic.jpg");

            foreach($dirs as $dir)
                rmdir($dir);

            $user->delete($email, $user_id);
            Auth::logout();
            session_start();
            $_SESSION['error_message'] = "Your account has been deleted.";

            echo "true";


        } else {

            echo "Wrong Password";
        }

    }


    if(isset($_FILES["profile-pic-file"])) {
        if ($_FILES['profile-pic-file']['size'] > 0) {

            $allowed_ext = array("jpeg", "jpg", "png");
            $ext_ex = explode(".", $_FILES["profile-pic-file"]["name"]);
            $extension = end($ext_ex);

            $file_type = $_FILES["profile-pic-file"]["type"];
            $file_size = $_FILES["profile-pic-file"]["size"];
            $temp_lc = $_FILES["profile-pic-file"]["tmp_name"];
            $dir_path = "../users/" . $user_id . "/img/profilepic.jpg";

            if (((($file_type == "image/jpeg") || ($file_type == "image/jpg") || ($file_type == "image/JPG")) || ($file_type == "image/png"))
                && ($file_size < 500000) //500000 bytes = 500KB
                && in_array($extension, $allowed_ext)
            ) {

                if ($_FILES["profile-pic-file"]["error"] > 0) {

                    echo "3"; // error 1 = "Sorry, an error occurred try again"
                } else if (move_uploaded_file($temp_lc, $dir_path)) {
                    echo $user_id; // no error, file was upload successfully
                } else echo "3"; // general error
            } else echo "2"; // error 2 = has to be jpg, jpeg, or png

        } else echo "1"; // error 1 = "Please select a file"
    }

        if(isset($_POST['delete_profile_pic'])){

            $dir_path = "../users/".$user_id."/img/profilepic.jpg";

            if(file_exists($dir_path)){
                unlink($dir_path);
                echo "picture deleted";
            }else echo "error deleting picture";

        }
}