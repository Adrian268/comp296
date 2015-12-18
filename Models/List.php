<?php
require_once 'Model.php';
require_once 'SharedList.php';
require_once 'User.php';

class Lists extends Model{

    protected  $table = 'lists';
    protected  $fillables = ['user_id', 'list_name', 'editable'];
    public     $creator;

    function __construct(){
        parent::__construct();
    }

    function delete($list_id, $user_id)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE list_id=:list_id AND user_id=:user_id");
        $query->bindParam(':list_id', $list_id);
        $query->bindParam(':user_id', $user_id);

        $query->execute();
    }

    function update($name, $editable, $list_id, $user_id){
            $query = $this->db->prepare("UPDATE $this->table SET list_name =:list_name, editable:=:editable WHERE user_id=:user_id AND list_id =:list_id");
            $query->bindParam(':list_name', $name);
            $query->bindParam(':editable', $editable);
            $query->bindParam(':list_id', $list_id);
            $query->bindParam(':user_id', $user_id);

            $query->execute();
    }

    function getSharedWithNames($list_id){
        $shared_list = new SharedList();
        $user = new User();
        $user_data = [];

        $data = $shared_list->getSharedWith($list_id);

        foreach($data as $index => $list){
            $user_data[$index]  = $user->show('user_id', $list['viewer_id']);
        }

        return $user_data;

    }


}
