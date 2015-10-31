<?php
require_once 'database.php';

$db = new Database;
$email = trim(strtolower($_GET['email']));

$query = $db->query("SELECT email FROM users WHERE email='$email'");

$result = $query->fetch(PDO::FETCH_ASSOC);

if($result['email'] === $email)
    echo json_encode(false);
else echo json_encode(true);