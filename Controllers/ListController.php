<?php
require_once '../util/database.php';
require_once '../models/lists.php';

$list_name = ucwords(strtolower(rtrim($_POST['new_shopping_list'])));
$user_id = $_SESSION['id'];
$editable = 0;
$list = new Lists();

$list->create($user_id, $list_name, $editable);

if($user_id != false && $list->save()){
    View::render('dashboard.php');
}else{
    $_SESSION['error_message'] = "Could not save list.";
    View::render('dashboard.php');
}





