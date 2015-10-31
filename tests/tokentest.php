<?php
$db = new PDO('mysql:host=localhost;dbname=listappdb', 'root', '');

$email = 'adriian591@gmail.com';
$token = '371ef4f0d78215519367f45ae0e79d96e94d124f';

$query = $db->query("SELECT * FROM password_resets WHERE email='$email' && token='$token'");

$data = $query->fetch(PDO::FETCH_ASSOC);

$created_at = strtotime($data['created_at']);
$expiration_time = $created_at + 2100;
$current_time = time();

echo "Time Created: " . date("M d, Y h:i:s a", $created_at) . "<br/>";

echo "Expiration Time: " . date("M d, Y h:i:s a", $expiration_time) . "<br/>";

echo "Current Time: " . date("M d, Y h:i:s a", $current_time) . "<br/>";

if(($expiration_time) < $current_time ){
    echo "<br> Token has expired";
}else echo "<br> Valid token";
