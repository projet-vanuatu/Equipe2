<?php
    require_once ("fonctionMatiere.php");
    $resM = RecupererMatiere();
    
    
    if(!empty($_GET['idm'])){
       $DomaineM = $_GET['choixDomaine'];
       $UEM = $_GET['choixUE']; 
       $nomMat = $_GET['intituleM'];
       $typeM = $_GET['choixTypeMatiere'];
       $nbHeuresM = $_GET['nbHeuresM'];
       $idm=$_GET['idm'];
       modifierM($idm,$nomMat,$typeM,$nbHeuresM,$UEM,$DomaineM);
        
    }
    else{
        if(isset($_GET['intituleM'])){
           if(isset($_GET['choixTypeMatiere'])){
               if(isset($_GET['nbHeuresM'])){
                    $DomaineM = $_GET['choixDomaine'];
                    $UEM = $_GET['choixUE']; 
                    $nomMat = $_GET['intituleM'];
                    $typeM = $_GET['choixTypeMatiere'];
                    $nbHeuresM = $_GET['nbHeuresM'];
                    $insert = InsererM($nomMat, $UEM, $DomaineM);
                }
            }
        }
    }
   
        
        
    
?>