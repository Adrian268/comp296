<?php
require_once 'init.php';


class Index{

    public function __construct(){
        $page = 'index';

        // check for error or confirm messages
        if(isset($_SESSION['error_message']))
            $er_msg = $_SESSION['error_message'];


        if(isset($_SESSION['confirm_message']))
            $cf_msg = $_SESSION['confirm_message'];

        // check if a session has been started to restrict navigating to index.php while logged in
        if(!Auth::check())
            require_once 'views/indexview.php';
    }
}

new Index();


