<?php
require_once 'Model.php';

class SharedList extends Model{

    protected  $table = 'shared_lists';
    protected  $fillables = ['user_id', 'viewer_id', 'list_id'];

    function __construct(){
        parent::__construct();
    }

    public function check($user_id, $viewer_id, $list_id){

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE user_id=:user_id AND viewer_id=:viewer_id AND list_id=:list_id");
        $query->bindValue(':user_id', $user_id);
        $query->bindValue(':viewer_id', $viewer_id);
        $query->bindValue(':list_id', $list_id);
        $query->execute();

        return ($query->fetchAll(PDO::FETCH_ASSOC))? true : false;
    }

    public function getSharedLists($user_id){

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE viewer_id=:user_id");
        $query->bindValue(':user_id', $user_id);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getSharedWith($list_id){

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE list_id=:list_id");
        $query->bindValue(':list_id', $list_id);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

}






