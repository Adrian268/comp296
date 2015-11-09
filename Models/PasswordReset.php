<?php
require_once 'Model.php';
require_once '../Util/Email.php';

class PasswordReset extends Model{

    protected $token;
    protected $table = 'password_resets';

    protected $email =[
        "subject"    => "Password Reset Link",
        "body"       => "Follow the link below to reset your password:\nIf you did not request a password reset, simply ignore this email\n",
        "reset_link" => "http://localhost/listapp/resetpassword.php?token="
    ];

    // create an email reset token
    public function __construct(){
        parent::__construct();
        $this->token = bin2hex(openssl_random_pseudo_bytes(20));
    }


    // send a password reset link email
    public function sendPasswordLink($email){

        try {

            $mailer = new Email;

            $this->email['body'] .= $this->email['reset_link'].$this->token;

            if($mailer->sendEmail($email, $this->email['subject'], $this->email['body'])){
                $this->saveToken($email);
            };

            return true;

        } catch (Swift_SwiftException $e) {
            return false;
        }

    }

    // insert token and email to database,
    protected function saveToken($email){

        $query = $this->db->prepare("INSERT INTO $this->table (email, token) VALUES (:email,:token)");
        $query->bindParam(':email', $email);
        $query->bindParam(':token', $this->token);
        $query->execute();
    }

}
