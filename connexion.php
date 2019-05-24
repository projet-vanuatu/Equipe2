<?php
define("SERVEUR_HTTP","localhost");
define("ID","21100905");
define("DB","db_21100905");
define("MDP","35952H");

function dbConnect(){
    $servername = 'localhost';
    $db = 'db_21100905';
    $username = '21100905';
    $password = '35952H';
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;    
}
 function ConnectDB(){
    $connexion=mysqli_connect(SERVEUR_HTTP,ID,MDP) or die("Problème de connexion".mysqli_connect_error());
    $session=mysqli_select_db($connexion,DB) or die("Problème d'ouverture de la BD".mysqli_connect_error());
    return $connexion;
 }
