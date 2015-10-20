<?php
require_once "Session.php";
new Session();

class View{

    static function render($path){
        header('Location: ' . $path);
    }

}
