<?php

    try{
        $db_connection = new PDO('mysql:host=localhost;dbname=listappdb', 'root', '', array(PDO::ATTR_PERSISTENT => true));
        $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        $e->getMessage();
        die("$e database connection error");
    }







