<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'un Etudiant</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="font/font/css/all.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/bootstrap-5.1.3/dist/css/bootstrap.min.css"/>
    <script src="bootstrap-5.1.3/bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/popper.min.js"></script>
    
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Marque anle accueil -->
  <a class="navbar-brand fa fa-home fa-fw" style="margin-left: 20px;" href="index.php"></a><i class="text-light text-center" style="margin-left: -5px;font-family: var(--bs-body-font-family);">Accueil</i>

  <!-- boutton menu pour mobile -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar lien -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" style="margin-left: 20px;" href="etudiant.php">Etudiants</a>
    </li>
    </ul>
  </div>
</nav>
<?php
    
$connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes', 'root', '');
$connPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!isset($_POST['supprimer'])){

//utilisation de GET a lieu de POST car no_inscription a ete tranfere par URL
$no_inscription = $_GET['no_inscription'];

$requete = ("SELECT * fROM etudiant WHERE no_inscription='$no_inscription';");

$result = $connPDO->query($requete);

//recuperation des donnees en tableau associatif (PDO::FETCH_ASSOC)
$data = $result->fetch(PDO::FETCH_ASSOC);


?>

<form action="suppr_etudiant.php" method="post">
<div class="container">
        <div class="small-box dark-box auto text-center" style="height:550px">
            <div class="col-md-12">
                <h3 class="text-center text-light">
                Supprimer vos Informations
                </h3>
                </div>
        <table class="mb-5">
            <tr>
                <td class="text-light">Nom : </td>
                <td class="text-light">
                <input class="form-control" type="text" name="nom" size="50" value="<?=$data['nom']?>" readonly>
                </td>            
            </tr>
            <tr>
                <td class="text-light">Adresse : </td>
                <td class="text-light">
                <input class="form-control" type="text" name="adresse" size="50" value="<?=$data['adresse']?>" readonly>
                </td>            
            </tr>
            <tr>
                <td class="text-light">Sexe : </td>
                <td class="text-light">
                <input class="form-control" type="text" name="adresse" size="50" value="<?=$data['sexe']?>" readonly>
                             
                </td>            
            </tr>
            <tr>
            <tr><td class="text-light">Niveau :

            </td><td class="text-light">
            <input class="form-control" type="text" name="adresse" size="50" value="<?=$data['niveau']?>" readonly>
                    
            </tr>
                    <tr><td class="text-light">Annee :

                    </td><td class="text-light">
                    <input class="form-control" type="text" name="adresse" size="50" value="<?=$data['annee']?>" readonly>
                 
                       
        </table>
        <div class="d-flex justify-content-center">
                        <tr>
                        <br>
                            <td><input class="btn btn-outline-success" style="margin-left:10px;" type="submit" value="Supprimer" name="supprimer"></td>

                        </tr>   
            </div>
        </div>
    </div>
    <input type="hidden" name="no_inscription" value="<?=$no_inscription?>">
    

</form>
        <?php

         $result->closeCursor();

        }else{
            $no_inscription = $_POST['no_inscription'];
            $requete = ("DELETE FROM etudiant WHERE no_inscription='$no_inscription' ");
            $result = $connPDO->exec($requete);

                if(!$result){
                    echo '<div class="alert alert-warning" role="alert">
                        Erreur! Suppression Annule 
                        </div>';
                    }
                    else{
                        echo '<div class="alert alert-success" role="alert">
                        Suppression réussi 
                        </div>';
                }
            }
        
           
        
        ?>



    
</body>
</html>