<?php

function dbConnect(){
    $servername = 'localhost';
    $db = 'db_21100905';
    $username = '21100905';
    $password = '35952H';
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;    
}
