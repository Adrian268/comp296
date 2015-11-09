<?php
require_once 'Database.php';
require_once 'Session.php' ;

class Auth {

    //logging in users
    static function attempt($email, $password){

        $db = new Database();

        $email = strtolower($email);

        $query = $db->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindValue(':email', $email);
        $query->setFetchMode(PDO::FETCH_OBJ);
        $query->execute();

        if($data = $query->fetch()){
            if($email===$data->email && password_verify($password, $data->password)){
                Session::set($data->user_id, $data->email, $data->name);
                return true;
            }
        }
        return false;
    }

    // check if a session has been started to restrict navigating to other pages while logged in
    static function check(){

        if(Session::started()){

            View::render('dashboard.php');
            return true;
        }

        Session::clear();
        return false;
    }

    static function loggedIn(){

        if(!Session::started()) {
            $_SESSION['error_message'] = "Access denied. Please Log In to view this page";
            View::render('index.php');
            return false;
        }

        return true;
    }

    // clears session variables and unsets session
    static function logout(){
        Session::clear();
    }
}

