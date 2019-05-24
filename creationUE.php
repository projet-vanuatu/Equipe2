<html>
<meta charset="UTF-8">

<?php
require_once 'fonctionUE.php';
if (!empty($_GET["idue"])){
    $idue=$_GET["idue"];
    $type=$_GET["type"];
    
    if ($type=='S'){
        if(verifierMatieres($idue)==0){
           supprimerUE($idue);
           header('Location: gestionUE.php');
        }
        else{   
            echo "<script>";
            echo "alert('Vous ne pouvez pas supprimer cette UE : Il y a"." ". verifierMatieres($idue)." "."matière(s) dans cette UE')";
            echo "</script>";
            $URL="gestionUE.php";
            echo "<script>location.href='$URL'</script>";            
        }
    }
}    
    
?>

</html>
