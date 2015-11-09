<?php

class Token{

    static $ER_MSG = "Sorry this link has expired. Click on forgot password for a new password reset link";

    static function validateToken($token){

        $db = new Database;

        $query = $db->prepare("SElECT * FROM password_resets where token = :token");
        $query->bindParam(':token', $token);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if(!self::checkTokenDate(strtotime($data['created_at']))){ // if self::checkExpirationDate returns 'false'

            $query = $db->prepare("DELETE FROM password_resets where token = :token");
            $query->bindParam(':token', $token);
            $query->execute();

            $_SESSION['error_message'] = self::$ER_MSG;
            View::render('index.php');
        }

    }

    protected function checkTokenDate($created_at){

        $minutes = 1200; // 3600 seconds = 30 minutes

        $expiration_time = $created_at + $minutes;
        $current_time = time();

        return ($expiration_time < $current_time) ? false : true; // returns false if the token is invalid
    }
}