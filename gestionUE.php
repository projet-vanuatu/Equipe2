<?php
    require_once 'fonctionUE.php';
    $UE = rechercherNomUENomF();
    $matieres = rechercherMatieres();  
?>

<html>
    <head>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../public/style.css">
        <script src="javascript.js"></script>
        <title>Title of the document</title>
    </head>
    <body>
        <div class="myNavbar">
            <div class="navbar-header">
                <img src="../public/logo.jpg" alt="Logo" style="width:52px;">
            </div>
            <a href="../homeAdmin.html">Accueil</a>
            <div class="subnav">
                <button class="subnavbtn">Création &nbsp;<i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                <a href="creationUtilisateurs.html">Utilisateurs</a>
                <a href="#company">Formations</a>
                <a href="#company">Salles</a>
                <a href="#company">Matériels</a>
                <a href="#company">Unités d'enseignements</a>
                <a href="#company">Matières</a>
                </div>
            </div> 
            <div class="subnav">
                <button class="subnavbtn">Gestion &nbsp;<i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="gestionUtilisateurs.html">Utilisateurs</a>
                    <a href="#company">Formations</a>
                    <a href="#company">Salles</a>
                    <a href="#company">Matériels</a>
                    <a href="#company">Unités d'enseignements</a>
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
                    <a href = "../index.html" class="subnavbtn2">Deconnection&nbsp;<span class="glyphicon glyphicon-log-in"></span></a>
            </div>
            <div class="subnav2">
                <button class="subnavbtn3"><span class="glyphicon glyphicon-user"></span>&nbsp;Nom Prénom</button>
            </div>
        </div>
            
        <br>
        <br>

        <!-- Sub-Nav -->
        <!-- style="color: #352109; font-size: 15px;" -->
        <div class="container">
            <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link acstive" onclick="afficherUE();">Unités d'enseignements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="afficherMatieres()">Matières</a>
                    </li>               
            </ul>
        </div>

        <br>

        <!-- Recherche -->
        <div class="container" id="UE" style="display:block;">
            <div class="row">
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="myInput" onkeyup="myFunction();" placeholder="Rechercher.." title="">
                </div>
                <div class="col-sm-4">
                    <a href="creationUE.php"<button class="btn btn-primary">Créer une UE</button></a>
                </div>
            </div>

            <br>
            
            
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-hover" id="myTable">
                    <thead class="header">
                        <tr>
                            <th>Nom UE</th>
                            <th>Formation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<=count($UE)-1;$i++){
                        ?>
                        <tr>
                            <td><?php echo($UE[$i]['IntituleUE']); ?></td>
                            <td><?php echo $UE[$i]['IntituleF']; ?></td>
                            <td><p><a href="<?php echo "creationUE.php?idue=".$UE[$i]['IdUE']; ?>&type=M"><button class="btn btn-warning">Modifier</button></a>
                                    <a href="<?php echo "creationUE.php?idue=".$UE[$i]['IdUE']; ?>&type=S"><button class="btn btn-danger">Supprimer</button></p></a>
                                </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- contaier -->
        <div class="container" id="Matieres" style="display:none;">
            <div class="row">
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="myInput" onkeyup="myFunction();" placeholder="Rechercher.." title="">
                </div>
                <div class="col-sm-4">
                    <a href="creationMatieres.php"<button class="btn btn-primary">Créer une matière</button></a>
                </div>
            </div>
            <br>        
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-hover" id="myTable">
                    <thead class="header">
                        <tr>
                            <th>Intitulé</th>
                            <th>Type</th>
                            <th>Heures fixées</th>
                            <th>UE</th>                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<=count($matieres)-1;$i++){
                        ?>
                        <tr>
                            <td><?php echo ($matieres[$i]['IntituleM']); ?></td>
                            <td><?php echo ($matieres[$i]['TypeM']); ?></td>
                            <td><?php echo ($matieres[$i]['NbHeuresFixees']); ?></td>
                            <td><?php echo ($matieres[$i]['IntituleUE']); ?></td> 
              
                            <td><p><a href="<?php echo "creationMatieres.php?idm=".$matieres[$i]['NumM']; ?>&type=M"><button class="btn btn-warning">Modifier</button></a>
                                <a href="<?php echo "creationMatieres.php?idm=".$matieres[$i]['NumM']; ?>&type=S"><button class="btn btn-danger">Supprimer</button></p></a></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            });
            function afficherUE(){
                document.getElementById("UE").style.display = "block";
                document.getElementById("Matieres").style.display = "none";
                

            }
            function afficherMatieres(){
                document.getElementById("UE").style.display = "none";
                document.getElementById("Matieres").style.display = "block";
                
            }
        </script>
    </body>
</html>