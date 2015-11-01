<?php
require_once 'init.php';

class Index{

    public function __construct(){
        require_once 'views/index.php';
    }
}

new Index();