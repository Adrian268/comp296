<?php
require_once '../models/item.php';
require_once '../util/database.php';

if(isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $item = new Item();

    if (isset($_POST['add_item'])) {

        $item_name = ucwords(strtolower(rtrim($_POST['add_item'])));
        $list_id = $_POST['list_id'];
        $quantity = 3;
        $purchased = 0;

        $item->create($list_id, $user_id, $item_name, $quantity, $purchased);

        if ($item_name != "") {
            $item->save();
            View::render('dashboard.php');
        } else {
            $_SESSION['error_message'] = "Please enter a list name";
            View::render('dashboard.php');
        }


    }
}

