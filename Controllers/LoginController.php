<?php
require_once '../Util/Session.php';
require_once '../Util/Connection.php';
require_once '../Util/Auth.php';
require_once '../Util/View.php';

class Login {

    private $ER_MSG = 'Invalid EMAIL or PASSWORD. Try again';

    function __construct(){

    }

    function tryLogin($email, $password, $db){

        if (Auth::attempt($email, $password , $db)) {
            Session::loggedIn();
            View::render('../user/profile.php');
        } else {
            Session::setError($this->ER_MSG);
            View::render('../index.php');
        }

    }

    function tryLogOut(){
        Auth::logout();
        View::render('../index.php');
    }


}

$login = new Login();

if(isset($_POST['log_in'])) {
    $login->tryLogin($_REQUEST['email'], $_REQUEST['password'], $db_connection);
}
else if (isset($_GET['log_out'])) {
        $login->tryLogOut();
}else{

}


/**previous code**/
//$MESSAGE = 'Invalid EMAIL or PASSWORD. Try again';
//
//if(isset($_POST['log_in'])) {
//
//    if (Auth::attempt($_REQUEST['email'], $_REQUEST['password'], $db_connection)) {
//        Session::loggedIn();
//        View::render('../user/profile.php');
//
//    } else {
//        Session::setError($MESSAGE);
//        View::render('../index.php');
//
//    }
//}
//else if (isset($_GET['log_out'])) {
//        Auth::logout();
//        View::render('../index.php');
//}else{
//    Auth::logout();
//    View::render('../index.php');
//}
