<?php
//include '../Util/Connection.php';
//require_once '../Util/Session.php';
//new Session();
require_once 'Model.php';

class User extends Model{

    public $name = "", $email = "", $phone_number = "", $password = "";

    public $this_is_an_entry = "testing if this variable works";

    function __construct($name, $email, $phone_number, $password){
        parent::__construct();

        $this->table = "users";
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->password = $password;
    }

    public function save(){
        $this->db->query($this->getQuery());
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

}


