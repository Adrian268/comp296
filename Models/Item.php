<?php
require_once 'Model.php';


class Item extends Model{

    protected  $table = 'items';
    protected  $fillables = ['list_id', 'user_id', 'item_name', 'quantity'];

    function delete($item_id, $user_id, $session_id){

        if($user_id == $session_id || $this->listIsEditable($item_id)){

            $query = $this->db->prepare("DELETE FROM $this->table WHERE item_id=:item_id AND user_id=:user_id");
            $query->bindParam(':item_id', $item_id);
            $query->bindParam(':user_id', $user_id);
            $this->listIsEditable($item_id);

            $query->execute();

            return true;
        }

        return false;
    }

    function update($name, $quantity, $user_id, $item_id, $session_id){

        if($user_id == $session_id || $this->listIsEditable($item_id)) {

            $query = $this->db->prepare("UPDATE $this->table SET item_name=:item_name, quantity=:item_quantity  WHERE user_id=:user_id AND item_id =:item_id");

            $query->bindParam(':item_name', $name);
            $query->bindParam(':item_quantity', $quantity);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':item_id', $item_id);

            $query->execute();
            return true;
        }

        return false;
    }

    function setAsPurchased($purchased = 0, $item_id, $user_id){
        $query = $this->db->prepare("UPDATE $this->table SET purchased=:purchased WHERE item_id=:item_id AND user_id=:user_id");

        $query->bindParam(':purchased', $purchased);
        $query->bindParam(':item_id', $item_id);
        $query->bindParam(':user_id', $user_id);

        $query->execute();
    }

    function listIsEditable($item_id){

        $item = $this->show('item_id', $item_id);

        $query = $this->db->prepare("SELECT editable FROM lists WHERE list_id=:list_id");
        $query->bindParam(':list_id', $item[0]['list_id']);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['editable'] == 1 ? true : false;
    }

}
