<?php
require_once 'fonctionUE.php';
if (!empty($_GET)){
    $id=$_GET["id"];
    $type=$_GET["type"];
    

    if ($type=='S'){
      supprimerMatieres($id);
      header('Location: gestionUE.php');
        
    }
}
?>

