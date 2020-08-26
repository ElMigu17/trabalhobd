<?php

$username = "root";
$servername = "localhost";

try{
    $pdo = new PDO("mysql:host=$servername;port=3306;dbname=bd-hospital", $username);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection Failed:" . $e->getMessage();
    }
?>