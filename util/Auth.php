<?php
require_once 'Session.php';
require_once '../Models/UserModel.php';

require_once '../Util/Connection.php';

class Auth {

    static function attempt($email, $password,$db){

        $query = $db->query("SELECT * FROM users WHERE email='$email'");
        $query->setFetchMode(PDO::FETCH_OBJ);

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