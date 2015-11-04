<?php
require_once '../util/database.php';
require_once '../models/lists.php';

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

    if (isset($_POST['delete_list'])) {
        $list_id = $_POST['list_id'];

        $list->delete($list_id, $user_id);
        View::render('dashboard.php');
    }


}

