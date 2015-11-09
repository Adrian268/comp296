<?php
require_once 'Session.php';
new Session();

class View{

    static function render($view){

        header('Location: http://localhost/listapp/'.$view);

    }

}
