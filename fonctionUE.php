<?php
    require 'connexion.php';

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

function supprimerUE($IdUE){
    $db=dbConnect();
    $sql="DELETE FROM UNITE_ENSEIGNEMENT
          WHERE IdUE=$IdUE";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}

function supprimerMatieres($NumM){
    $db=dbConnect();
    $sql="DELETE FROM MATIERES
          WHERE NumM=$NumM";
    $stmt = $db->prepare($sql);
    $stmt->execute();  
}

function verifierSeance($NumM){
    $db = dbConnect();
    $sql="SELECT m.NumM, s.NumS  
          FROM SEANCES s, MATIERES m
          WHERE s.NumM=m.NumM
          AND m.NumM=$NumM";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}   

function verifierEnseigne($NumM){
    $db = dbConnect();
    $sql="SELECT IdENS  
          FROM ENSEIGNE
          WHERE NumM=$NumM";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}   