<?php
class Session {

    static $er_msg;

    function __construct(){
        session_start();
    }

    static function set($id, $email, $name){
        $name = explode(" ",$name);
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = trim(ucfirst($name[0]));
        return true;
    }

    static function started(){
        if(isset($_SESSION['email']))
            return true;
        return false;
    }

    static function clear(){
        session_unset();
        session_destroy();
    }
}