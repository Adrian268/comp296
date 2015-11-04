<?php
require_once 'init.php';
require_once 'models/lists.php';

class Dashboard{

    public function getData(){
        $lists = new Lists();
        return $lists->show('user_id', $_SESSION['id']);

    }

    public function view($data = []){
        require_once 'views/dashboard.php';
    }

    public function sayHello(){
        echo "hello";
    }
}

if(!Session::started()) {
    $_SESSION['error_message'] = "Access denied. Please Log In to view this page";
    View::render('index.php');
}else{
    $dashboard = new Dashboard();
    $dashboard->view($dashboard->getData());
}

