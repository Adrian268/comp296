<?php
require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class Email extends Swift{

    public $mailer;

    // email connection settings: host, port, username, password
    protected $smtp_host = "ssl://smtp.gmail.com"; // email host server
    protected $port = 465;                         // email host server port
    protected $user_name = 'adrian56h@gmail.com';  //email to send from
    protected $password = '1!password';            // password

    // sender email information: email, name
    protected $sender_email = "ListApp@domain.com";
    protected $sender_name = "List Application";

    //set email settings, create mailer instance
    public function __construct(){

        $transport = Swift_SmtpTransport::newInstance($this->smtp_host, $this->port)
            ->setUsername($this->user_name)
            ->setPassword($this->password);

        $this->mailer = Swift_Mailer::newInstance($transport);
    }


    // takes a recipient email, email subject, email body
    public function sendEmail($recipient, $subject, $body){

        $message = Swift_Message::newInstance($subject)
            ->setFrom(array($this->sender_email => $this->sender_name))
            ->setTo(array($recipient => 'User'))
            ->setBody($body);

        return ($this->mailer->send($message)) ? true : false ;
    }

}