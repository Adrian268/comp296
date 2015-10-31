<?php
require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class Email extends Swift{

    public $mailer;
    protected $smtp_host = "ssl://smtp.gmail.com";
    protected $port = 465;
    protected $user_name = 'adriian591@gmail.com';
    protected $password = 'iFox458!';
    protected $sender_email = "ListApp@domain.com";
    protected $sender_name = "List Application";

    protected $emailBodies =[
        "ResetPassword" => "Follow the link below to reset your password:\nIf you did not request a password reset, simply ignore this email\n",

    ];

    function __construct(){

        $transport = Swift_SmtpTransport::newInstance($this->smtp_host, $this->port)
            ->setUsername($this->user_name)
            ->setPassword($this->password);

        $this->mailer = Swift_Mailer::newInstance($transport);
    }

    function sendEmail($recipient, $subject, $body){

        $message = Swift_Message::newInstance($subject)
            ->setFrom(array($this->sender_email => $this->sender_name))
            ->setTo(array($recipient => 'User'))
            ->setBody($body);

        $this->mailer->send($message);

    }

    function emailBody($body_type, $link){

       return $this->emailBodies[$body_type] . $link;

    }

}