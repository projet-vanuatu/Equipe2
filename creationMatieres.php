<html>
<meta charset="UTF-8">

<?php
require_once 'fonctionUE.php';
if (!empty($_GET["idm"])){
    $idm=$_GET["idm"];
    $type=$_GET["type"];
    if ($type=='M'){
        
        
        
        
    } 
    if ($type=='S'){
        if(verifierSeance($idm)==0){
                supprimerMatieres($idm);
                header('Location: gestionUE.php');
            }
        else{
            echo "<script>";
            echo "alert('Vous ne pouvez pas supprimer cette matière : Il y a"." ". verifierSeance($idm)." "."séance(s) de cette matière prévues')";
            echo "</script>";
            $URL="gestionUE.php";
            echo "<script>location.href='$URL'</script>";
            
            }
    } 
}
?>

</html>