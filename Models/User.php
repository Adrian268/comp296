<?php
require_once 'Model.php';

class User extends Model{

    protected  $table = 'users';
    public $name = "", $email = "", $phone_number = "", $password = "";

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

    function resetPassword($password, $email, $user_id){

        $this->db->query("UPDATE $this->table SET password='$password' WHERE email='$email' AND user_id='$user_id'");

    }

    function update($name, $email, $user_id){
        $query = $this->db->prepare("UPDATE $this->table SET name =:name, email=:email WHERE user_id=:user_id");
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':user_id', $user_id);

        $query->execute();
    }

    function delete($email, $user_id)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE email=:email AND user_id=:user_id");
        $query->bindParam(':email', $email);
        $query->bindParam(':user_id', $user_id);

        $query->execute();
    }

    function createUserDir($email){
        $query = $this->db->prepare("SELECT user_id FROM $this->table WHERE email=:email");
        $query->bindParam(':email', $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $path = "./../users/".$result['user_id']. "/img";

        if(!file_exists($path)){

            if(!mkdir($path, 0777, true))
                return false;

        }else return false;

        return true;
    }

}