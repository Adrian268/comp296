<?php
require_once '../models/item.php';
require_once '../models/note.php';
require_once '../util/database.php';

if(isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $item = new Item();


    if (isset($_POST['new_item_name'])) {

        $item_name = ucwords(strtolower(rtrim($_POST['new_item_name'])));
        $list_id = $_POST['list_id'];
        $quantity = 1;

        if(rtrim($_POST['new_item_quantity']) != ""){
            $quantity = $_POST['new_item_quantity'];
        }

        $item->create($list_id, $user_id, $item_name, $quantity);

        if ($item_name != "") {
            $item_id = $item->save();

            if(isset($_POST['new_item_note']) && rtrim($_POST['new_item_note']) != ""){
                addNote($item_id, $user_id, $_POST['new_item_note'] );
            }
                echo json_encode([
                                'name' => $item_name,
                                'list_id' => $list_id,
                                'quantity' => $quantity,
                                'id' => $item_id
                            ]);

        }
    }

    if(isset($_POST['delete_item'])){

        $item_id = $_POST['item_id'];

        $item->delete($item_id, $user_id);
    }


    if(isset($_POST['edit_item']) && rtrim($_POST['edit_item_name']) != ""){

        $item_name = $_POST['edit_item_name'];
        $item_quantity = $_POST['edit_item_quantity'];
        $item_id = $_POST['item_id'];

        $item->update($item_name, $item_quantity, $user_id, $item_id);

    }
}

function addNote($item_id, $user_id, $content){
    $note = new Note();

    $note->create($item_id, $user_id, $content);
    $note->save();


}