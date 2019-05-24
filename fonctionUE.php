<?php
    require 'connexion.php';
    
//Fonction d'affichage des UE
function rechercherNomUENomF(){
    $db = dbConnect();
    $sql="SELECT u.IdUE, u.IntituleUE, f.IntituleF
          FROM UNITE_ENSEIGNEMENT u, FORMATION f
          WHERE u.IdF=f.IdF";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}
//Fonction d'affichage des matières
function rechercherMatieres(){
    $db = dbConnect();
    $sql="SELECT m.NumM, m.IntituleM, m.TypeM, m.NbHeuresFixees, u.IntituleUE
          FROM MATIERES m, UNITE_ENSEIGNEMENT u
          WHERE u.IdUE=m.IdUE";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}

//fonction supp/modifUE
function suppModifUE(){
    if (!empty($_GET["idue"])){
        $idue=$_GET["idue"];
        $type=$_GET["type"];  
        if ($type=='M'){
            $modif[1]= recupererModif($idue)['IntituleUE'];
            $modif[2]= recupererModif($idue)['IdF'];
        }
        if ($type=='S'){
            if(verifierMatieres($idue)==0){
               supprimerUE($idue);
               echo "<script>";
               echo "alert('La suppression a bien été prise en compte')";
               echo "</script>"; 
               $URL="gestionUE.php";
               echo "<script>location.href='$URL'</script>";
            }
            else{   
                echo "<script>";
                echo "alert('Vous ne pouvez pas supprimer cette UE : Il y a"." ". verifierMatieres($idue)." "."matière(s) dans cette UE')";
                echo "</script>";
                $URL="gestionUE.php";
                echo "<script>location.href='$URL'</script>";            
            }
        }
        $modif[3]=$idue;
    }
    else{ 
        $modif[1]=null;
        $modif[2]=null;
        $modif[3]=null;
    }
    return $modif;
}

//fonction supp/modifUE
function suppModifMatiere(){
    if (!empty($_GET["idm"])){
    $idm=$_GET["idm"];
    $type=$_GET["type"];
        if ($type=='M'){


        } 
        if ($type=='S'){
            if(verifierSeance($idm)==0){
                supprimerMatieres($idm);
                echo "<script>";
                echo "alert('La suppression a bien été prise en compte')";
                echo "</script>"; 
                $URL="gestionUE.php";
                echo "<script>location.href='$URL'</script>";
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
}
//Fonction de suppression d'un UE
function supprimerUE($IdUE){
    $db=dbConnect();
    $sql="DELETE FROM UNITE_ENSEIGNEMENT
          WHERE IdUE=$IdUE";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}
//Fonction de suppression de matière
function supprimerMatieres($NumM){
    $db=dbConnect();
    $sql1="DELETE FROM ENSEIGNE WHERE NumM=$NumM";
    $stmt1 = $db->prepare($sql1);
    $stmt1->execute();
    $sql2="DELETE FROM MATIERES WHERE NumM=$NumM";
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute();
    
}
//Fonction de verification de séance
function verifierSeance($NumM){
    $cx=connectDB();
    $sql="SELECT COUNT(*) AS nb  
          FROM SEANCES s, MATIERES m
          WHERE s.NumM=m.NumM
          AND m.NumM=$NumM";
    $exe=mysqli_query($cx,$sql);
    $res=mysqli_fetch_array($exe);
    return $res['nb'];
}   
//Fonction de verification enseignement
function verifierEnseigne($NumM){
    $cx=connectDB();
    $sql="SELECT COUNT(*) AS nb  
          FROM ENSEIGNE
          WHERE NumM=$NumM";
    $exe=mysqli_query($cx,$sql);
    $res=mysqli_fetch_array($exe);
    return $res['nb'];
}   

//Fonction de verification de matiere
function verifierMatieres($NumUE){
    $cx=connectDB();
    $sql="SELECT COUNT(*) AS nb  
          FROM MATIERES
          WHERE IdUE=$NumUE";
    $exe=mysqli_query($cx,$sql);
    $res=mysqli_fetch_array($exe);
    return $res['nb'];
}   

 // RECUPERER INFORMATIONS UE
    function RecupererUE(){
        $conn = dbConnect();
        $sql = "SELECT IdUE, IntituleUE, IdF FROM UNITE_ENSEIGNEMENT";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $resUE = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resUE;
    }

    // RECUPERER INFOS FORMATION
    function RecupererFormation(){
        $conn = dbConnect();
        $sql = "SELECT IdF, IntituleF FROM FORMATION";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $resFormation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resFormation;
    }

    // RECUPERER FORMATION
    function RecupererIdF($nomFormation){
        $conn = ConnectDB();
        $searchIdF = "SELECT IdF FROM FORMATION WHERE IntituleF = '$nomFormation'";
        $querySearchIdF = mysqli_query($cx, $searchIdF);
        $resIdF = mysqli_fetch_array($querySearchIdF);
        return $resIdF['IdF'];
    }

    // INSERER UE
    function InsererUE ($nomUE, $resIdF){
        $cx = ConnectDB();
        $InsererUE = "INSERT INTO UNITE_ENSEIGNEMENT(IdUE, IntituleUE, IdF) VALUES (NULL, '$nomUE', '$resIdF')";
        $queryInsererUE = mysqli_query($cx,$InsererUE);
        if($queryInsererUE){
            header('Location: creationUE.php');
        }
    }
    
   
    function recupererModif($idue){
        $cx= ConnectDB();
        $sql="SELECT u.IntituleUE, f.IdF
          FROM FORMATION f, UNITE_ENSEIGNEMENT u
          WHERE u.IdF=f.IdF
          AND u.IdUE=$idue";
    $query = mysqli_query($cx, $sql);
        $res = mysqli_fetch_array($query);
        return $res;
    }
    
    function modifierUE($idue,$intue,$idf){
        $cx = ConnectDB();
        $updateUE = "UPDATE UNITE_ENSEIGNEMENT SET IntituleUE = '$intue',IdF = '$idf' WHERE IdUE=$idue";
        $queryupdateUE = mysqli_query($cx,$updateUE);
        if($queryupdateUE){
            header('Location: gestionUE.php');
        }
    }
    
    
