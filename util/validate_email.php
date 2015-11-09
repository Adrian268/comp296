<?php
require_once 'database.php';

$db = new Database;
$email = trim(strtolower($_GET['email']));

$query = $db->prepare("SELECT email FROM users WHERE email=:email");
$query->bindParam(':email', $email);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);

echo ($result['email'] === $email) ? json_encode(false) : json_encode(true);
