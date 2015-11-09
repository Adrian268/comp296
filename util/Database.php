<?php
require_once 'view.php';

// Extends PHP PDO database connection class
class Database extends PDO{

    private $host        = 'localhost';
    private $dbname      = 'listappdb';
    private $username    = 'root';
    private $password    = '';

    public function __construct(){

        // try to connect to the database, otherwise redirect to index.php with error
        try{
            parent::__construct('mysql:host='.$this->host.';dbname='.$this->dbname.'', ''.$this->username.'', ''.$this->password.'', array(PDO::ATTR_PERSISTENT => true));
        }catch(PDOException $e){
            $_SESSION['error_message'] = "Sorry, an error occurred. Please try again later.";
            View::render('index.php');
        }
    }
}