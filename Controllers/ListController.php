<?php
require_once '../util/database.php';
require_once '../models/List.php';
require_once '../models/SharedList.php';

if(isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $list = new Lists();

    if (isset($_POST['add_new_list'])) {
        $list_name = ucwords(strtolower(rtrim($_POST['list_name'])));
        $editable = (isset($_POST['list_permission_check'])) ? 1 : 0;

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

            case 'save':
                $new_name = ucwords(strtolower(rtrim($_POST['list_name'])));
                $editable = $_POST['list_permission'];
                saveList($list, $new_name, $editable, $list_id, $user_id);
                echo $new_name;
                break;
            case 'delete':
                deleteList($list, $list_id, $user_id);
                break;
        }
    }


    if(isset($_POST['share_list_rqst'])){

        $list_id = $_POST['shared_list_id'];
        $contacts_id = $_POST['shared_with_contacts'];
        $shared_list = new SharedList();
        $names = [];

        foreach($contacts_id as $contact){

            if(!($shared_list->check($user_id, $contact, $list_id))){

                $shared_list->create($user_id, $contact, $list_id);
                $shared_list->save();

                $contact_name = getNameForSharedContact($contact);

                $name = explode(" ",$contact_name['name']);

                array_push($names, trim(ucfirst($name[0])));

            }

        }

        echo json_encode($names);

    }
}

function getNameForSharedContact($id){
    $db = new Database();
    $query = $db->prepare("SELECT name FROM users WHERE user_id=:user_id");
    $query->bindParam(':user_id', $id);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);

    return $data;
}


//delete list
function deleteList(Lists $list, $list_id, $user_id){

    $list->delete($list_id, $user_id);
}

// save edited list
function saveList(Lists $list, $new_name,$editable, $list_id, $user_id){

    $list->update($new_name, $editable, $list_id, $user_id);
}