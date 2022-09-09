<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificaction d'une Matiere</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/bootstrap-5.1.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="font/font/css/all.css">
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
      <a class="nav-link" style="margin-left: 20px;" href="matiere.php">Matières</a>
    </li>
    </ul>
  </div>
</nav>
<?php
    
$connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes', 'root', '');
$connPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!isset($_POST['modif'])){

//utilisation de GET a lieu de POST car no_inscription a ete tranfere par URL
$codemat = $_GET['codemat'];

$requete = ("SELECT * fROM matiere WHERE codemat='$codemat';");

$result = $connPDO->query($requete);

//recuperation des donnees en tableau associatif (PDO::FETCH_ASSOC)
$data = $result->fetch(PDO::FETCH_ASSOC);


?>

<form action="modif_matiere.php" method="post">
<div class="container">
        <div class="small-box dark-box auto text-center" style="height:550px">
            <div class="col-md-12">
                <h3 class="text-center text-light">
                Modification de la matière
                </h3><br>
            </div>
        <table class="mb-3">
            <tr>
                <td class="text-light">Libelle : </td>
                <td>
                <input class="form-control" type="text" name="libelle" size="50" value="<?=$data['libelle']?>">
                </td>            
            </tr>
            <tr>
                <td class="text-light">Coefficient : </td>
                <td>
                <input class="form-control" type="number" name="coef" size="50" value="<?=$data['coef']?>">
                </td>            
            </tr>
                      
        </table>
                <div class="d-flex justify-content-center">
                        <tr>
                        <br><td><input class="text-center btn btn-outline-danger" style="margin-right: 10px;" type="reset" value="Effacer" name="effacer"></td>
                            <td><input class="text-center btn btn-outline-success" style="margin-left: 10px;" type="submit" value="Enregistrer" name="modif"></td>

                        </tr> 
                </div>
            </div>
        </div>
    <input type="hidden" name="codemat" value="<?=$codemat?>">
                         

</form>
        <?php

         $result->closeCursor();

        }else if(isset($_POST['libelle']) && isset($_POST['coef'])){

            $libelle = $_POST['libelle'];
            $coef = $_POST['coef'];
            $codemat = $_POST['codemat'];

            $requete = $connPDO->prepare('UPDATE matiere SET libelle=:libelle, coef=:coef WHERE codemat=:codemat');
            
                $requete->bindValue(':codemat', $codemat);
                $requete->bindValue(':libelle', $libelle);
                $requete->bindValue(':coef', $coef);

                $result = $requete->execute();

                if(!$result){
                    echo '<div class="alert alert-warning" role="alert">
                    Erreur!
                    </div>';
                }else{
                    echo '<div class="alert alert-success" role="alert">
                    Vos modifications on été enregistrés
                    </div>';
                }
        }else{
                echo "Modifier vos informations";
        }
        
           
        
        ?>



    
</body>
</html>