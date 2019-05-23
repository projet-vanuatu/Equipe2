<?php
require_once 'fonctionUE.php';
if (!empty($_GET)){
    $id=$_GET["id"];
    $type=$_GET["type"];
    

    if ($type=='S'){
      supprimerUE($id);
      header('Location: gestionUE.php');
        
    }
}
verifierSeance($id);
verifierEnseigne($id);
?>

