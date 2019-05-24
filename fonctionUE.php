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