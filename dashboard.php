<?php
require_once 'init.php';


class Dashboard{

    public function __construct($page_body){

        // check for messages
        if(isset($_SESSION['confirm_message'])){
            $cf_msg = $_SESSION['confirm_message'];
            $_SESSION['confirm_message'] = null;
        }

        $user_data = $this->getData(new User(), $_SESSION['id']);
        $list_data = $this->getData(new Lists(), $_SESSION['id']);
        $item_data = $this->getData(new Item(), $_SESSION['id']);
        $note_data = $this->getData(new Note(), $_SESSION['id']);

        $contact_data = $this->getData(new Contact(), $_SESSION['id']);
        $contacts = [];

        $shared_list_data = $this->getData(new SharedList(), $_SESSION['id']);
        $shared_lists_names = [];

        $shared_lists = new SharedList();
        $shared_lists_id = $shared_lists->getSharedLists($_SESSION['id']);
        $shared_with_id = [];
        $shared_with_names = [];
        $shared_lists_info = [];
        $shared_item_info = [];
        $shared_note_info = [];

        //get shared list and item data
        for($i = 0 ; $i < count($shared_lists_id) ; $i++){
            $list = new Lists();
            $list_being_shared = new SharedList();
            $item = new Item();

            $shared_lists_info[$i] = $list->show('list_id', $shared_lists_id[$i]['list_id']);
            $shared_with_id[$i] = $list_being_shared->getSharedWith($shared_lists_id[$i]['list_id']);

            $shared_item_info[$i] = $item->show('list_id', $shared_lists_id[$i]['list_id']);
        }

        //find who each shared lists is being shared with
        $user_num = 0;
        foreach( $shared_with_id as $shared_with){
            $user = new User();
            for($i = 0 ; $i< count($shared_with) ; $i ++){
                $shared_with_names[$user_num] = $user->show('user_id', $shared_with[$i]['viewer_id']);
                $user_num++;
            }
        }

        // get shared note data
        $note_num = 0;
        foreach($shared_item_info as $item_array){
            $note = new Note();

            for($i = 0 ; $i < count($item_array) ; $i ++){
                $shared_note_info[$note_num] = $note->show('item_id', $item_array[$i]['item_id']);
                $note_num++;
            }


        }


        //get shared list names
        for($i = 0 ; $i < count($shared_list_data) ; $i++){
            $user = new User();

            $shared_lists_names[$i] = $user->show('user_id', $shared_list_data[$i]['viewer_id']);
        }

        // get contacts information
        for($i = 0 ; $i < count($contact_data) ; $i++){
            $user = new User();
            $contacts[$i] = $user->show('user_id', $contact_data[$i]['contact_id']);
        }


        require_once 'views/dashboardtemplate.php';
    }

    // takes a model class to retrieve data
    public function getData(Model $model, $user_id){

        return $model->show('user_id', $user_id);

    }
}


// check if session is not started to restrict access to dashboard.php
if(Auth::loggedIn()){

    new Dashboard('lists');
}





