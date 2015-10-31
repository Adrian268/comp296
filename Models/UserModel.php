<?php
require_once 'Model.php';

class User extends Model{

    public $name = "", $email = "", $phone_number = "", $password = "";
    public $table = "users";

    function __construct(){
        parent::__construct();
    }

    public function save($name, $email, $phone_number, $password){

        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->password = $password;

        if($this->db->query($this->getQuery()))
        return true;

        return false;
    }

    private function insertableFields(){

        return "(name, email, phone_number, password)";
    }

    private function prepareValues(){

        return "('$this->name', '$this->email', '$this->phone_number', '$this->password')";

    }

    function getQuery(){
        return "INSERT INTO $this->table " .
            $this->insertableFields() . " values " .
            $this->prepareValues();
    }

    function resetPassword($password, $email){

        $this->db->query("UPDATE $this->table SET password='$password' WHERE email='$email'");

    }

}


