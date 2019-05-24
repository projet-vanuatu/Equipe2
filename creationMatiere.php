<?php
    require ("fonctionUE.php");
    require_once 'fonctionUE.php';
    $resUE = RecupererUE();
    $resFormation = RecupererFormation();
    
    suppModifMatiere();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <script src="javascript.js"></script>
        <title>Insertion UE</title>
    </head>

    <body>
        <div class="myNavbar">
            <div class="navbar-header">
                <img src="images/logo.JPG" alt="Logo" style="width:52px;">
            </div>
            <a href="homeAdmin.php">Accueil</a>
            <div class="subnav">
                <button class="subnavbtn">Création &nbsp;<i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                <a href="creationUtilisateurs.html">Utilisateurs</a>
                <a href="#company">Formations</a>
                <a href="#company">Salles</a>
                <a href="#company">Matériels</a>
                <a href="creationUE.php">Unités d'enseignements</a>
                <a href="creationMatiere.php">Matières</a>
                </div>
            </div> 
            <div class="subnav">
                <button class="subnavbtn">Gestion &nbsp;<i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="gestionUtilisateurs.html">Utilisateurs</a>
                    <a href="#company">Formations</a>
                    <a href="#company">Salles</a>
                    <a href="#company">Matériels</a>
                    <a href="gestionUE.php">Unités d'enseignements</a>
                    <a href="#company">Matières</a>
                </div>
            </div>
            <div class="subnav">
                <button class="subnavbtn">Consulter planning &nbsp;<i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="#company">Par formation</a>
                    <a href="#company">Par salle</a>
                    <a href="#company">Par enseignant</a>
                </div>
            </div>
            <div class="subnav2">
                <a href = "index.php" class="subnavbtn2">Deconnection&nbsp;<span class="glyphicon glyphicon-log-in"></span></a>
            </div>
            <div class="subnav2">
                <button class="subnavbtn3"><span class="glyphicon glyphicon-user"></span>&nbsp;Nom Prénom</button>
            </div>
        </div>
            
        <br>
        <br>
        <div class="container">
            <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link acstive" href="creationUE.php">Unités d'enseignement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="creationMatiere.php">Matières</a>
                    </li>
            </ul>
        </div>
        <div class="container" id="Etudiants" style="display:block;">
          <div class="row content">
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
              <br>
              <h4>Insertion simple</h4>
              <br>
              <form action="resCreerUE.php" method = GET>
                  
                  
                  
                  
                  <div class="form-group">
                    <label for="pwd">Intitulé :</label>
                    <input type="text" class="form-control" id="nomMat" placeholder="Nom" name="intituleM">
                  </div>
                  
                  
                  <div class="form-group"> 
                    <label for="sel1">Type :</label>
                    <select class="form-control" id="sel1" name="formationUE">
                      <option selected >Choisir un type de matière </option>
                          <?php             
                              for($i=0;$i<=count($resFormation)-1;$i++){
                          ?>
                              <Option value ="<?php echo $resFormation[$i]['IdF'] ?>"><?php echo $resFormation[$i]['IntituleF'] ?></option>     
                          <?php
                              }
                          ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="pwd">Nombre d'heures :</label>
                    <input type="number" pattern="[0,999]" class="form-control" id="nbHeuresMat" placeholder="Entrer un nombre" name="nbHeuresM">
                  </div>
                  
                  
                  
                  
                  <button type="submit" class="btn btn-primary btn-block">Créer</button>
              </form>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
              <br>
                <h4>Insertion CSV</h4>
                <br>
                <form>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input custom-control-label" id="customFile">
                    <label class="custom-file-label" for="customFile">Choisir un fichier</label>
                  </div>
                </form>
            </div>
        </div>
        <div class="col-sm-1"></div>
      </div>
    <footer class="container-fluid"></footer>
    <script>
        function afficherEtudiant(){
            document.getElementById("Etudiants").style.display = "block";
            document.getElementById("Enseignants").style.display = "none";
            document.getElementById("Gestionnaires").style.display = "none";
        }
        function afficherEnseignant(){
            document.getElementById("Etudiants").style.display = "none";
            document.getElementById("Enseignants").style.display = "block";
            document.getElementById("Gestionnaires").style.display = "none";
        }
        function afficherGestionnaire(){
            document.getElementById("Etudiants").style.display = "none";
            document.getElementById("Enseignants").style.display = "none";
            document.getElementById("Gestionnaires").style.display = "block";
        }
    </script>
  </body>
</html>
