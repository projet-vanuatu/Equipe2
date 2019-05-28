<html>
    <head>
        <meta charset="UTF-8"> 
<?php
    require_once 'connexion.php';
    require_once 'fonctionMatiere.php';
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


    //fonction supp/modifUE
    function suppModifUE(){
        if (!empty($_GET["idue"])){
            $idue=$_GET["idue"];
            $type=$_GET["type"];  
            if ($type=='M'){
                $modif[1]= recupererModifUE($idue)['IntituleUE'];
                $modif[2]= recupererModifUE($idue)['IdF'];
            }
            if ($type=='S'){                
                   supprimerUE($idue);
                   echo "<script>";
                   echo "alert('La suppression a bien été prise en compte')";
                   echo "</script>"; 
                   $URL="gestionUE.php";
                   echo "<script>location.href='$URL'</script>";               
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

    //Fonction de suppression d'un UE
    function supprimerUE($IdUE){
        $cx= ConnectDB();
        $NumM= retrouveMatiereUE($IdUE);
        $NumS=recupererSeance($NumM);     
        $sql1="DELETE FROM RESERVER WHERE NumS=$NumS";
        $query1=mysqli_query($cx,$sql1);    
        $sql2="DELETE FROM DISPENSE WHERE NumS=$NumS";
        $query2=mysqli_query($cx,$sql2);
        $sql3="DELETE FROM SEANCES WHERE NumS=$NumS";
        $query3=mysqli_query($cx,$sql3);
        $sql4="DELETE FROM ENSEIGNE WHERE NumM=$NumM";
        $query4=mysqli_query($cx,$sql4);
        $sql5="DELETE FROM MATIERES WHERE NumM=$NumM";
        $query5=mysqli_query($cx,$sql5);
        $sql6="DELETE FROM UNITE_ENSEIGNEMENT WHERE IdUE=$IdUE";
        $query6=mysqli_query($cx,$sql6);
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
            echo "<script>";
            echo "alert('Insertion effectuée')";
            echo "</script>";
            $URL="gestionUE.php";
            echo "<script>location.href='$URL'</script>"; 
        }
    }
      
    function recupererModifUE($idue){
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
            echo "<script>";
            echo "alert('Modification enregistrée')";
            echo "</script>";
            $URL="gestionUE.php";
            echo "<script>location.href='$URL'</script>"; 
        }
    }
    
    function retrouveMatiereUE($idue){
        $cx= ConnectDB();
        $sql="SELECT NumM FROM MATIERES WHERE IdUE=$idue";
        $query=mysqli_query($cx,$sql);
        $res= mysqli_fetch_array($query);
        return $res['NumM'];
    }
    
    ?>
</html>
