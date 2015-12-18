<?php
require_once 'init.php';


class Dashboard{

    public function __construct(){

        // check for messages
        if(isset($_SESSION['confirm_message'])){
            $cf_msg = $_SESSION['confirm_message'];
            $_SESSION['confirm_message'] = null;
        }

        $user_model = new User();
        $list_model = new Lists();
        $item_model = new Item();
        $note_model = new Note();
        $contact_model = new Contact();
        $shared_list_model = new SharedList();

        $user_data = $user_model->show('user_id', $_SESSION['id']);
        $list_data = $list_model->showAll('user_id', $_SESSION['id']);
        $item_data = $item_model->showAll('user_id', $_SESSION['id']);
        $note_data = $note_model->showAll('user_id', $_SESSION['id']);


        // GET CONTACT DATA
        $contact_data = $contact_model->showAll('user_id', $_SESSION['id']);
        $contacts = [];

        foreach($contact_data as $index => $contact){

            $contacts[$index] = $user_model->show('user_id', $contact_data[$index]['contact_id']);
        }

        // GET SHARED LIST DATA FOR THE USERS LISTS
        $shared_list_data = $shared_list_model->showAll('user_id', $_SESSION['id']);

        // GET NAMES FOR WHOM THE USER IS SHARING LISTS WITH
        foreach($list_data as $list){
            $shared_lists_names = $list_model->getSharedWithNames($list['list_id']);
        }


        // DATA FOR THE LISTS BEING SHARED WITH THE USER
        $shared_lists_id = $shared_list_model->getSharedLists($_SESSION['id']);
        $shared_with_id = [];
        $shared_lists_info = [];
        $items_from_shared_lists = [];
        foreach($shared_lists_id as $index => $shared_list){

            $shared_lists_info[$index] = $list_model->show('list_id', $shared_lists_id[$index]['list_id']);
            $shared_with_id[$index] = $shared_list_model->getSharedWith($shared_lists_id[$index]['list_id']);

            $items_from_shared_lists[$index] = $item_model->showAll('list_id', $shared_lists_id[$index]['list_id']);
        }

        $shared_item_info = [];
        foreach($items_from_shared_lists as $item_array){
            foreach($item_array as $item){
                array_push($shared_item_info, $item);
            }
        }

        //find who each shared lists is being shared with
        $shared_with_names = [];
        $user_num = 0;
        foreach( $shared_with_id as $shared_with){

            for($i = 0 ; $i< count($shared_with) ; $i ++){
                $shared_with_names[$user_num] = $user_model->showAll('user_id', $shared_with[$i]['viewer_id']);
                $user_num++;
            }
        }

        // GET SHARED NOTE DATA
        $shared_note_info = [];
        $note_num = 0;
        foreach($shared_item_info as $item){

            $shared_note_info[$note_num] = $note_model->showAll('item_id', $item['item_id']);
            $note_num++;

        }

        $shared_note_data = [];
        foreach($shared_note_info as $shared_note){
            foreach($shared_note as $note){
                array_push($shared_note_data, $note );
            }
        }// end note loop

        $page = "dashboard";
        $profile_pic_path = 'users/'.$user_data['user_id'].'/img/profilepic.jpg';

        require_once 'views/dashboardview.php';
    }

}


// check if session is not started to restrict access to dashboard.php
if(Auth::loggedIn()){

    new Dashboard();
}





