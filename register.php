<?php
require_once 'init.php';

class Register{

    public function __construct($data = []){
        require_once 'views/register.php';
    }
}

new Register();