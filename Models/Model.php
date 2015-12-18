<?php

abstract class Model
{

    protected $table;
    protected $fillables = [];
    protected $values = [];

    function __construct()
    {
        $this->db = new Database();
    }

    function save()
    {
        $query = $this->db->prepare("INSERT INTO $this->table (" . $this->getFillables() . ") VALUES (" . $this->getValues() . ")");

        for ($i = 0; $i < count($this->values); $i++) {
            ${$this->fillables[$i]} = $this->values[$i];
            $query->bindValue(':' . $this->fillables[$i], ${$this->fillables[$i]});
        }

        $query->execute();

        // returning the auto incremented id
        return $this->db->lastInsertId();

    }

    function create()
    {
        $args = func_num_args();

        for ($i = 0; $i < $args; $i++)
            $this->values[$i] = func_get_arg($i);
    }

    function getFillables()
    {
        $string = "";

        foreach ($this->fillables as $key => $value)
            $string .= $value . ",";

        return rtrim(trim($string), ',');
    }

    function getValues()
    {
        $string = "";

        foreach ($this->fillables as $key => $value)
            $string .= " :" . $value . ",";

        return (rtrim(trim($string), ','));
    }

    function show($field, $value, $select_one = true){

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $field=" . ':' . "$field");
        $query->bindValue(':' . $field, $value);
        $query->execute();

        if ($select_one == false) {
            $dt_array = [];
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $dt) {

                $dt['creator'] = $this->setName($dt['user_id']);
                array_push($dt_array, $dt);
            }
            return $dt_array;
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $result['creator'] = $this->setName($result['user_id']);
        return $result;

    }

    function showAll($field, $value){
        return $this->show($field, $value, $select_one = false);
    }

    function getUserId($field, $value){
        $query = $this->db->prepare("SELECT user_id FROM $this->table WHERE $field=" . ':' . "$field");
        $query->bindValue(':'.$field, $value);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    function setName($user_id){
        $query = $this->db->prepare("SELECT name FROM users WHERE user_id=:user_id");
        $query->bindValue(':user_id', $user_id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $name = explode(" ", $data['name']);

        return rtrim(ucfirst($name[0]));

    }

}

