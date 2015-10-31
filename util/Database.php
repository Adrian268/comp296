<?php
require_once 'view.php';
class Database extends PDO{

    public function __construct(){
        try{
            parent::__construct('mysql:host=localhost;dbname=listappdb', 'root', '', array(PDO::ATTR_PERSISTENT => true));
        }catch(PDOException $e){
            session_start();
            $_SESSION['error_message'] = "Sorry, an error occurred. Please try again later.";
            View::render('index.php');
        }
    }
}