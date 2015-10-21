<?php
$password = 'password';

$password = password_hash($password, PASSWORD_BCRYPT);

echo $password;
echo "<br>";

if(password_verify('Password', $password)){
    echo "passwords match";
}else echo "passwords do not match";


echo "<br/>";

$email = "email@domain.com";

strtolower($email);

echo $email . "<br/>";

strtolower($email);

echo $email . "<br/>";