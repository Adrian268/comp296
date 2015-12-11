<?php
require_once '../models/item.php';
require_once '../models/note.php';
require_once '../models/List.php';
require_once '../util/database.php';

function userId(Model $model, $field, $value){
    $user_id_data = $model->getUserId($field, $value);
    return $user_id_data['user_id'];
}

if(isset($_SESSION['id'])) {
    $item = new Item();


    if (isset($_POST['new_item_name'])) {

        $list_id = $_POST['list_id'];
        $user_id = userId(new Lists(), 'list_id', $list_id);

        $item_name = ucwords(strtolower(rtrim($_POST['new_item_name'])));
        $quantity = rtrim($_POST['new_item_quantity']) != "" ? $quantity = $_POST['new_item_quantity'] : 1;

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
        $user_id = userId($item, 'item_id', $item_id);

        if($item->delete($item_id, $user_id, $_SESSION['id']))
            echo "true";
        else{
            $_SESSION['error_message'] = "Permissions for that list have changed. Could not delete item.";
            echo "false";
        }
    }


    if(isset($_POST['edit_item']) && rtrim($_POST['edit_item_name']) != ""){

        $item_name = ucwords(strtolower(rtrim($_POST['edit_item_name'])));
        $item_quantity = $_POST['edit_item_quantity'];
        $item_id = $_POST['item_id'];
        $user_id = userId($item, 'item_id', $item_id);

        if($item_quantity < 1)
            $item_quantity = 1;

        if($item->update($item_name, $item_quantity, $user_id, $item_id, $_SESSION['id'])){

            echo json_encode([

                'name' => $item_name,
                'quantity' => $item_quantity,

            ]);
        }else {

            $_SESSION['error_message'] = "Permissions for that list have changed. Could not edit item.";
            echo "false";
        }



    }


    if(isset($_POST['set_item_as_purchased'])){

        $item_id = $_POST['item_id'];
        $purchased = $_POST['purchased'];
        $user_id = userId($item, 'item_id', $item_id);

//        $item->setAsPurchased($purchased,$item_id, $user_id);
    }
}

function addNote($item_id, $user_id, $content){
    $note = new Note();

    $note->create($item_id, $user_id, $content);
    $note->save();
}