<?php

$connection = null;

try{
    //config
    $host = "localhost";
    $username = "root";
    // $no_hp = "";
    $email = "";
    $password = "";
    $dbname = "laundry";

    //connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password );
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    // if($connection){
    //     echo "jadi";
    // } else { 
    //     "gagal";
    // }
}

catch(PDOException $e){
    echo "error ! " . $e->getMessage();
    die;
}

?>