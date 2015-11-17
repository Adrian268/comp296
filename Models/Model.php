<?php

abstract class Model {

    protected $table;
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

        $query->execute();

        // returning the auto incremented id
        return $this->db->lastInsertId();

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

    function show($field, $value){
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $field=" . ':' . "$field");
        $query->bindValue(':'.$field, $value);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

}


