<?php
require_once 'init.php';
require_once 'models/List.php';
require_once 'models/Item.php';

class Dashboard{

    public function __construct(){

        // check for messages
        if(isset($_SESSION['confirm_message'])){
            $cf_msg = $_SESSION['confirm_message'];
            $_SESSION['confirm_message'] = null;
        }

        $list_data = $this->getData(new Lists());
        $item_data = $this->getData(new Item());

        require_once 'views/dashboard.php';
    }

    // takes a model class to retrieve data
    public function getData(Model $model){

        return $model->show('user_id', $_SESSION['id']);

    }
}

// check if session is not started to restrict access to dashboard.php
if(Auth::loggedIn()){

    new Dashboard();
}





