<?php
require_once 'Session.php';
include_once '../Models/Users.php';


class Auth {

    static function attempt($email, $password, $db_connection){

        $query = $db_connection->query("SELECT email, password FROM users WHERE email='$email'");
        $query->setFetchMode(PDO::FETCH_CLASS, 'User');

        if($data = $query->fetch()){
            if($email==$data->email && $password==$data->password)
                return true;
        }
        return false;
    }

    static function logout(){
        Session::clear();
    }
}

//$_SESSION['encoded_vartopass'] = serialize($email);
//
//$query = $db_connection->query('SELECT * FROM users');
//
//$data = $query->fetch(PDO::FETCH_OBJ);
//
//echo $data->email, '<br>';

//header('location: index.php');