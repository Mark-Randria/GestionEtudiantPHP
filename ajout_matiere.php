<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matière</title>
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
      <a class="nav-link" style="margin-left: 20px;" href="matiere.php">Matières</a>
    </li>
    </ul>
  </div>
</nav>
    <?php

        //connection a la BDD
        $connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes','root', '');

        $connPDO ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['enregistrer']))
        {

            $libelle = $_POST['libelle'];
            $coef = $_POST['coef'];

            //verification des champs
            if(!empty($libelle) && !empty($coef))
            {
                $requete = $connPDO->prepare('INSERT into matiere(libelle, coef) VALUES (:libelle, :coef)');
                
                //bindvalue cad la liaison entre le parametre :$(parametres nomay ou qlch comme ca xD) par $
                $requete->bindValue(':libelle', $libelle);
                $requete->bindValue(':coef', $coef);


                //execution de la requete prepare
                $result = $requete->execute();

                    //verification du resultat
                    if (!$result){
                        echo 'erreur';
                    }
                    else{
                        echo '<div class="alert alert-success" role="alert">
                        Enregistrement réussi 
                        </div>';
                    }        
            }else{
                echo '<div class="alert alert-danger" role="alert">
                Tous les champs sont requis! 
                </div>';
            }
        }
    ?>
<form action="ajout_matiere.php" method="post">
    <div class="container">
        <div class="small-box dark-box auto text-center" style="height:550px">
            <div class="col-md-12">
            <br>
            <h3 class="text-center text-light">Informations du matiere </h3>
            <br>
            </div>
                <table>
                        <tr><td class="text-center text-light">Libelle :</td><td><input class="form-control" type="text" name="libelle" size="50" maxlength="50" autocomplete="off"></td></tr> 
                       
                        <tr><td class="text-center text-light">Coefficient :</td><td><input class="form-control" type="number" name="coef" size="50" maxlength="50" placeholder="3 caracteres max" autocomplete="off"></td></tr>

 
                </table>
<br><br>                
                    <div class="d-flex justify-content-center">
                        <tr>
                            <td><input class="text-center btn btn-outline-danger" style="margin-right:10px;" type="reset" value="Effacer" name="effacer"></td>
                            <td><input class="text-center btn btn-outline-success" style="margin-left:10px;" type="submit" value="Enregistrer" name="enregistrer"></td>

                        </tr>
                    </div>
        </div>
</div>

            
           

</body>
</html>