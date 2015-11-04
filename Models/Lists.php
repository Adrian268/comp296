<?php
require_once 'Model.php';

class Lists extends Model{

    public  $table = 'lists';
    protected  $fillables = ['user_id', 'list_name', 'editable'];
    protected  $values = [];

    function __construct(){
        parent::__construct();
    }

    function delete($list_id, $user_id)
    {
        $stmnt = $this->db->prepare("DELETE FROM $this->table WHERE list_id=:list_id AND user_id=:user_id");
        $stmnt->bindParam(':list_id', $list_id);
        $stmnt->bindParam(':user_id', $user_id);

        $stmnt->execute();

        echo "list has been deleted";
//        return ($stmnt->execute())?: false
    }
}
