<?php
require_once '../Util/Database.php'; // DELETE AFTER TESTING

class Model {

    public $table;
    public $fillables = [];
    public $values = [];

    function __construct(){
        $this->db = new Database();
    }

    function save(){
        $query = $this->db->prepare("INSERT INTO $this->table (" . $this->getFillables() .  ") VALUES (" . $this->getValues() . ")");
        echo "INSERT INTO $this->table (" . $this->getFillables() .  ") VALUES (" . $this->getValues() . ")";

        for($i = 0 ; $i < count($this->values) ; $i++ ){

            ${$this->fillables[$i]} = $this->values[$i];
            $query->bindValue(':' . $this->fillables[$i], ${$this->fillables[$i]});

            echo "<br>" . ${$this->fillables[$i]}. "<br>";
        }

        if($query->execute())
            echo "saved";
        else print_r($query->errorInfo());
    }

    function create(){
        $args = func_num_args();

        for($i = 0 ; $i < $args ; $i++)
            $this->values[$i] = func_get_arg($i);
    }

    function getFillables(){
        $amount = count($this->fillables);
        $string = "";

        for ($i = 0; $i < $amount; $i++){
            if($amount - $i != 1)
                $string .= $this->fillables[$i] . ", ";
            else
                $string .= $this->fillables[$i];

        }

        return $string;
    }

    function getValues(){
        $amount = count($this->fillables);
        $string = "";

        for ($i = 0; $i < $amount; $i++){
            if($amount - $i != 1)
                $string .= " :" . $this->fillables[$i] . ", ";
            else
                $string .= " :" . $this->fillables[$i];

        }

        return $string;
    }
}


