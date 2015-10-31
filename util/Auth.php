<?php
require_once 'Database.php';
require_once 'Session.php' ;

class Auth {

    static function attempt($email, $password){

        $db = new Database();

        $email = strtolower($email);

        $query = $db->query("SELECT * FROM users WHERE email='$email'");
        $query->setFetchMode(PDO::FETCH_OBJ);

        if($data = $query->fetch()){
            if($email===$data->email && password_verify($password, $data->password)){
                Session::set($data->user_id, $data->email, $data->name);
                return true;
            }
        }
        return false;
    }

    static function check(){

        if(Session::started()){

            View::render('dashboard.php');

            return true;
        }

        Session::clear();

        return false;
    }

    static function logout(){
        Session::clear();
    }
}

