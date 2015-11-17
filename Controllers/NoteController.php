<?php
require_once '../models/note.php';
require_once '../util/database.php';


if(isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $note = new Note();


    if (isset($_POST['note_content']) && rtrim($_POST['note_content']) != "") {

        $item_id = $_POST['item_id'];
        $content = rtrim($_POST['note_content']);

        $note->create($item_id, $user_id, $content);
        $note->save();

    };

};