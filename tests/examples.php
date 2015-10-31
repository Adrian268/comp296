<?php

//try{
//    $db_handler = new PDO('mysql:host=localhost;dbname=listappdb', 'root', '');
//    $db_handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}
// catch(PDOException $e)
//{
//    die('database connection error');
//}

class UserEntry {
    public $name, $email, $phone_number, $password,
        $entry;

    public function __construct() {
        $this->entry = "{$this->name} has a cool email: {$this->email}";
    }


}

$db_handler = new PDO('mysql:host=localhost;dbname=listappdb', 'root', '');

$email = 'adrian@email.com';

$query = $db_handler->query("SELECT * FROM users WHERE email='$email'");

$query->setFetchMode(PDO::FETCH_CLASS, 'UserEntry');


while($r = $query->fetch()){
    echo $r->entry, '<br>';
}


//$sql = "INSERT INTO users (name, email, password) VALUES ('mike', 'mike@mail.com', 'newpassword')";
//$db_handler->query($sql);


//$data = $query->fetch(PDO::FETCH_OBJ);
//echo $data->email, '<br>';

//while($data = $query->fetch(PDO::FETCH_OBJ)){
//    echo $data->email, '<br>';
//}