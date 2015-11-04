<?php
require_once 'Database.php';
require_once 'Session.php' ;

class Token{

    static function validateToken($token){

        $db = new Database;

        $query = $db->query("SElECT * FROM password_resets where token = '$token'");
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if(!self::compareTokens(strtotime($data['created_at']))){

            $db->query("DELETE FROM password_resets where token = '$token'");

            $_SESSION['error_message'] = "Sorry this link has expired. <a href='forgotpassword.php'>CLICK HERE</a> for a new password reset link";
            View::render('index.php');
        }

    }

    protected function compareTokens($created_at){

        $minutes = 300; // 3600 seconds = 30 minutes

        $expiration_time = $created_at + $minutes;
        $current_time = time();

        if($expiration_time < $current_time)
            return false;

        return true;

    }
}