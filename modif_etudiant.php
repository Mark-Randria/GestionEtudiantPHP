<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un Etudiant</title>
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
      <a class="nav-link" style="margin-left: 20px;" href="etudiant.php">Etudiants</a>
    </li>
    </ul>
  </div>
</nav>
<?php
    
$connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes', 'root', '');
$connPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!isset($_POST['modif'])){

//utilisation de GET a lieu de POST car no_inscription a ete tranfere par URL
$no_inscription = $_GET['no_inscription'];

$requete = ("SELECT * fROM etudiant WHERE no_inscription='$no_inscription';");

$result = $connPDO->query($requete);

//recuperation des donnees en tableau associatif (PDO::FETCH_ASSOC)
$data = $result->fetch(PDO::FETCH_ASSOC);


?>

<form action="modif_etudiant.php" method="post">
    <div class="container">
        <div class="small-box dark-box auto text-center" style="height:550px">
            <div class="col-md-12">
                <h3 class="text-center text-light">
                    Modifier vos Informations
                </h3><br>
            </div>
        <table class="mb-5">
            <tr>
                <td class="text-light">Nom : </td>
                <td>
                <input class="form-control" type="text" name="nom" size="50" value="<?=$data['nom']?>">
                </td>            
            </tr>
            <tr>
                <td class="text-light" style="width:70px;">Adresse : </td>
                <td>
                <input class="form-control" type="text" name="adresse" size="50" value="<?=$data['adresse']?>">
                </td>            
            </tr>
            <tr>
                <td class="text-light">Sexe : </td>
                <td>
                                <select class="form-control" name="sexe">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                </td>            
            </tr>
            <tr>
            <tr><td class="text-light">Niveau :

            </td><td>
                <select name="niveau" class="form-control">
                    <option value="L1">L1</option>
                <option value="L2">L2</option>
                <option value="L3">L3</option>
                <option value="M1">M1</option>
                <option value="M2">M2</option>
                </select>            
            </tr>
            <?php   
                        //variable year pour utiliser annee en liste deroulante
                        //range entre 1901 et 2155 car dans la BDD annee est de type year or year(4) ne supporte que 1901 et 2155
                        //pour des valeurs superieurs ou inferieur, utiliser le type INT dans la BDD, Bisous ze mamaky anito <3
                        $yearArray = range(1950, 2099);
            ?>
                    <tr><td class="text-light">Année :

                    </td><td>
                            <select name="annee" class="form-control" required>
                                <option value="">Choisir une année</option>
                            <?php
                            //ty boucle hoanle $annee atao anaty select sy option evitena anle andika <select> sy <option> maro rehefa kamo
                            //mila php vo mivoka fa afaka atao am javascript ko le izy xD
                             foreach ($yearArray as $annee)
                             {
                                 echo '<option value="'.$annee.'">'.$annee.'</option>';
                             }
                            ?>
                            </select>
                            </td>
                    </tr>
            </tr>
                       
        </table>
        <div class="d-flex justify-content-center">
                        <tr>
                        <br><td><input class="text-center btn btn-outline-danger" style="margin-right:10px;" type="reset" value="Effacer" name="effacer"></td>
                            <td><input class="text-center btn btn-outline-success" style="margin-left:10px;" type="submit" value="Enregistrer" name="modif"></td>

                        </tr>
                    </div>   

        </div>
        
    </div>
    <input type="hidden" name="no_inscription" value="<?=$no_inscription?>">
                   
</form>
        <?php

         $result->closeCursor();

        }else if(isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['sexe']) && isset($_POST['niveau']) && isset($_POST['annee'])){

            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $sexe = $_POST['sexe'];
            $niveau = $_POST['niveau'];
            $annee = $_POST['annee'];
            $no_inscription = $_POST['no_inscription'];

            $requete = $connPDO->prepare('UPDATE etudiant SET nom=:nom, adresse=:adresse, sexe=:sexe, niveau=:niveau, annee=:annee WHERE no_inscription=:no_inscription');
            
                $requete->bindValue(':no_inscription', $no_inscription);
                $requete->bindValue(':nom', $nom);
                $requete->bindValue(':adresse', $adresse);
                $requete->bindValue(':sexe', $sexe);
                $requete->bindValue(':niveau', $niveau);
                $requete->bindValue(':annee', $annee);

                $result = $requete->execute();

                if(!$result){
                    echo "<div class='alert alert-warning' role='alert'>
                    Un probleme a ete detecte, les modifications n'ont pas ete faites!
                    </div>";
                }else{
                    echo '<div class="alert alert-success" role="alert">
                    Modification réussi 
                    </div>';
                }
        }else{
            echo '<div class="alert alert-danger" role="alert">
            Tous les champs sont requis! 
            </div>';
        }
        
           
        
        ?>



    
</body>
</html>