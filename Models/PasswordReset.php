<?php
require_once 'Model.php';
require_once '../Util/Email.php';

class PasswordReset extends Model{

    public $token;

    function __construct(){
        parent::__construct();
        $this->table = 'password_resets';
        $this->token = bin2hex(openssl_random_pseudo_bytes(20));
    }

    function sendPasswordLink($email){

        $mailer = new Email;

        $this->saveToken($email);

        $subject = "Password Reset Link";

        $body = $mailer->emailBody("ResetPassword", "http://localhost/listapp/reset_password.php?token=$this->token");

        $mailer->sendEmail($email, $subject, $body);

        return true;

    }

    function saveToken($email){

        $this->db->query("INSERT INTO $this->table (email, token) VALUES ('$email','$this->token')");
    }

}
