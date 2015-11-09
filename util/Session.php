<?php
class Session {

    public function __construct(){
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

        return (isset($_SESSION['email'])&&isset($_SESSION['id'])) ? true : false;
    }

    static function clear(){
        session_unset();
        session_destroy();
    }
}