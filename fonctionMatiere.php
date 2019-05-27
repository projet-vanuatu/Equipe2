<html>
    <head>
        <meta charset="UTF-8"> 
<?php
    require_once ('connexion.php');

    // RECUPERER INFOS MATIERE
    function RecupererMatiere(){
        $conn = dbConnect();
        $sql = "SELECT NumM, IntituleM, TypeM, NbHeuresFixees, IdUE, IdDomaine FROM MATIERES";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $resM = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resM;
    }
    
    /* RECUPERER TYPE MATIERE
    function RecupererTypeM(){
        $conn = ConnectPDO();
        $sql = "SELECT TypeM FROM MATIERES WHERE TypeM = '$typeM'";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $resTypeM = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resTypeM;
    }*/

    // RECUPERER INFOS DOMAINE
    function RecupererDomaine(){
        $conn = dbConnect();
        $sql = "SELECT IdDomaine, Intitule_domaine FROM DOMAINE";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $resD = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resD;
    }
     
    // RECUPERER IDENTIFIANT UE
    function RecupererIdUE($UEM){
        
        $cx=ConnectDB();
        $searchIdUE = "SELECT IdUE FROM UNITE_ENSEIGNEMENT WHERE IntituleUE = '$UEM'";
        $querySearchIdUE = mysqli_query($cx, $searchIdUE);
        $resIdUE = mysqli_fetch_array($querySearchIdUE);
        return $resIdUE['IdF'];
    }
    
    // RECUPERER IDENTIFIANT DOMAINE
    function RecupererIdDomaine($DomaineM){
        
        $cx=ConnectDB();
        $searchIdDomaine = "SELECT IdDomaine FROM DOMAINE WHERE Intitule_domaine = '$DomaineM'";
        $querySearchIdDomaine = mysqli_query($cx, $searchIdDomaine);
        $resIdDomaine = mysqli_fetch_array($querySearchIdDomaine);
        return $resIdDomaine['IdF'];
    }
    
    // INSERER MATIERE
    function InsererM ($nomMat, $resIdUE, $resIdDomaine){
        $cx = ConnectDB();
        $DomaineM = $_GET['choixDomaine'];
        $UEM = $_GET['choixUE'];
        $typeM = $_GET['choixTypeMatiere'];
        $nbHeuresM = $_GET['nbHeuresM'];
        $InsererM = "INSERT INTO MATIERES(NumM, IntituleM, TypeM, NbHeuresFixees, IdUE, IdDomaine) "
                . "VALUES (NULL, '$nomMat', '$typeM', '$nbHeuresM', '$UEM', '$DomaineM')";
        $queryInsererUE = mysqli_query($cx,$InsererM);
        if($queryInsererUE){
            echo "<script>";
            echo "alert('Insertion effectuée')";
            echo "</script>";
            $URL="gestionUE.php";
            echo "<script>location.href='$URL'</script>"; 
        }
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

//fonction supp/modifMatieres
function suppModifMatiere(){
    if (!empty($_GET["idm"])){
    $idm=$_GET["idm"];
    $type=$_GET["type"];
        if ($type=='M'){
            $modif[1]= recupererModifM($idm)['IntituleM'];
            $modif[2]= recupererModifM($idm)['TypeM'];
            $modif[3]= recupererModifM($idm)['NbHeuresFixees'];
            $modif[4]= recupererModifM($idm)['IdUE'];
            $modif[5]= recupererModifM($idm)['IdDomaine'];
            
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
        $modif[6]=$idm;
    }
    else{
        $modif[1]= null;
        $modif[2]= null;
        $modif[3]= null;
        $modif[4]= null;
        $modif[5]= null;
        $modif[6]= null;
    }
    return $modif;
}

function recupererModifM($idM){
        $cx= ConnectDB();
        $sql="SELECT IntituleM, TypeM, NbHeuresFixees, IdUE, IdDomaine
          FROM MATIERES 
          WHERE NumM=$idM";
    $query = mysqli_query($cx, $sql);
        $res = mysqli_fetch_array($query);
        return $res;
    }
    
    function modifierM($idm,$intM,$typeM,$nbheure,$idue,$iddom){
        $cx = ConnectDB();
        $updateM = "UPDATE MATIERES SET IntituleM = '$intM',TypeM = '$typeM', NbHeuresFixees = '$nbheure',IdUE = '$idue', IdDomaine = '$iddom' WHERE NumM=$idm";
        $queryupdateM = mysqli_query($cx,$updateM);
        if($queryupdateM){
            echo "<script>";
            echo "alert('Modification enregistrée')";
            echo "</script>";
            $URL="gestionUE.php";
            echo "<script>location.href='$URL'</script>";
        }
    }
?>
</html>
