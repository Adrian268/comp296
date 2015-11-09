<?php
require_once '../util/database.php';
require_once '../models/List.php';

if(isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $list = new Lists();

    if (isset($_POST['add_new_list'])) {
        $list_name = ucwords(strtolower(rtrim($_POST['new_shopping_list'])));
        $editable = 0;

        $list->create($user_id, $list_name, $editable);

        if ($list_name != "") {
            $list->save();
            View::render('dashboard.php');
        } else {
            $_SESSION['error_message'] = "Please enter a list name";
            View::render('dashboard.php');
        }
    }

    if(isset($_POST['list_option'])){
        $list_id = $_POST['list_id'];

        switch($_POST['list_option']){

            case 'Save':
                $new_name = ucwords(strtolower(rtrim($_POST['list_name'])));
                saveList($list, $new_name, $list_id, $user_id);
                break;
            case 'Delete List':
                deleteList($list, $list_id, $user_id);
                break;
        }
    }
}


//delete list
function deleteList(Lists $list, $list_id, $user_id){

    $list->delete($list_id, $user_id);
    View::render('dashboard.php');
}

// save edited list
function saveList(Lists $list, $new_name, $list_id, $user_id){

    $list->update($new_name, $list_id, $user_id);
    View::render('dashboard.php');
}
