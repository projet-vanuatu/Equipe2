<?php
    require_once ("fonctionUE.php");
    $resUE = RecupererUE();
    $resFormation = RecupererFormation();
    if(!empty($_GET['idue'])){
        $nomUE = $_GET['intituleUE'];
        $resIdF = $_GET['formationUE'];
        $idue=$_GET['idue'];
        
        modifierUE($idue, $nomUE, $resIdF);
    }
    else{
        if(isset($_GET['intituleUE'])){
           if(isset($_GET['formationUE'])){
              $nomUE = $_GET['intituleUE'];
              $resIdF = $_GET['formationUE'];
              InsererUE($nomUE, $resIdF);
            }
        }
    }
?>

