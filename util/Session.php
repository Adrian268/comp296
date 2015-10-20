<?php

class Session {

    function __construct(){
        session_start();
    }

    static function loggedIn(){
        $_SESSION['logged_in'] = true;
    }

    static function isLoggedIn(){
        if(isset($_SESSION['logged_in']))
            return true;
        return false;
    }

    static function setError($message){
        $_SESSION['error_message'] = $message;
    }

    static function error(){
        if(isset($_SESSION['error_message']))
            return true;
        return false;
    }

    static function clear(){
        session_unset();
        session_destroy();
    }
}