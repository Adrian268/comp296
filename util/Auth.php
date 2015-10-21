<?php
require_once 'Session.php';
require_once '../Models/UserModel.php';

require_once '../Util/Connection.php';

class Auth {

    static function attempt($email, $password,$db){

        $email = strtolower($email);

        $query = $db->query("SELECT * FROM users WHERE email='$email'");
        $query->setFetchMode(PDO::FETCH_OBJ);

        if($data = $query->fetch()){
            if($email===$data->email && password_verify($password, $data->password))
                return true;
        }
        return false;
    }

    static function logout(){
        Session::clear();
    }
}

