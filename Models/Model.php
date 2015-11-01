<?php

abstract class Model {

    public $table;
    protected  $fillables = [];
    protected  $values = [];

    function __construct(){
        $this->db = new Database();
    }

    function save(){
        $query = $this->db->prepare("INSERT INTO $this->table (" . $this->getFillables() .  ") VALUES (" . $this->getValues() . ")");

        for($i = 0 ; $i < count($this->values) ; $i++ ){
            ${$this->fillables[$i]} = $this->values[$i];
            $query->bindValue(':' . $this->fillables[$i], ${$this->fillables[$i]});
        }

        return $query->execute();

    }

    function show($field, $value){
        $stmnt = $this->db->prepare("SELECT * FROM $this->table WHERE $field=" . ':' . "$field");
        $stmnt->bindValue(':'.$field, $value);
        $stmnt->execute();
        $data = $stmnt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
//        return "SELECT * FROM $this->table WHERE $field=" . ':' . "$field";

    }

    function create(){
        $args = func_num_args();

        for($i = 0 ; $i < $args ; $i++)
            $this->values[$i] = func_get_arg($i);
    }

    function getFillables(){
        $string = "";

        foreach($this->fillables as $key => $value)
            $string .= $value . ",";

        return rtrim(trim($string), ',');
    }

    function getValues(){
        $string = "";

        foreach($this->fillables as $key => $value)
            $string .= " :" . $value . ",";

        return (rtrim(trim($string), ','));
    }
}


