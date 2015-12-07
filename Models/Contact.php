<?php
require_once 'Model.php';

class Contact extends Model{

    protected  $table = 'contacts';
    protected  $fillables = ['contact_id', 'user_id'];

    public function check($contact_id, $user_id){

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE contact_id=:contact_id AND user_id=:user_id");
        $query->bindValue(':contact_id', $contact_id);
        $query->bindValue(':user_id', $user_id);
        $query->execute();

        return ($query->fetchAll(PDO::FETCH_ASSOC))? true : false;
    }

    function delete($contact_id, $user_id)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE contact_id=:contact_id AND user_id=:user_id");
        $query->bindParam(':contact_id', $contact_id);
        $query->bindParam(':user_id', $user_id);

        $query->execute();
    }

}