<?php
require_once '../util/database.php';

$db = new Database;
$email = 'adriian591@gmail.com';//trim(strtolower($_POST['post_email']));

$query = $db->query("SELECT email FROM users WHERE email='$email'");

$result = $query->fetch(PDO::FETCH_ASSOC);

echo "<pre>", print_r($result), "</pre>";

echo "<br/>" . $result['email'];

//if($result['email'] === $email)
//    echo "This email is already taken.";
//else
//    echo "";