<?php
require_once '../models/item.php';
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
            $item->save();
            View::render('dashboard.php');

        } else {
            $_SESSION['error_message'] = "Please enter item name";
            View::render('dashboard.php');
        }


    }
}

