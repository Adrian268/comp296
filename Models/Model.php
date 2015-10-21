<?php
require_once "../Util/Database.php";

class Model {

    public $table;
    public $model_name;
    public $value;

    function __construct()
    {
        $this->db = new Database();
//        try {
//            $this->db = new Database();
//            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $e) {
//            $e->getMessage();
//            die("$e database connection error");
//        }
    }


}


