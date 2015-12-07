<?php
require_once '../models/note.php';
require_once '../models/item.php';
require_once '../util/database.php';


if(isset($_SESSION['id'])) {

    $session_user_id = $_SESSION['id'];
    $note = new Note();


    if (isset($_POST['note_content']) && rtrim($_POST['note_content']) != "") {
        $item = new Item();

        $item_id = $_POST['item_id'];
        $content = rtrim($_POST['note_content']);
        $user_id = $item->getUserId('item_id', $item_id);

        $note->create($item_id, $user_id['user_id'], $content);
        $note->save();

    };

};