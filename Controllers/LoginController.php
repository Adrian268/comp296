<?php
require_once '../Util/Session.php';
require_once '../Util/Connection.php';
require_once '../Util/Auth.php';
require_once '../Util/View.php';

$MESSAGE = 'Invalid EMAIL or PASSWORD. Try again';

if(isset($_POST['log_in'])) {

    if (Auth::attempt($_REQUEST['email'], $_REQUEST['password'], $db_connection)) {
        Session::loggedIn();
        View::render('../user/profile.php');

    } else {
        Session::setError($MESSAGE);
        View::render('../index.php');

    }
}
else {

    if (isset($_GET['log_out'])) {
        Auth::logout();
        View::render('../index.php');
    }
}