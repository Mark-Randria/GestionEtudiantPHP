<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/bootstrap-5.1.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="font/font/css/all.css">
    <script src="bootstrap-5.1.3/bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/popper.min.js"></script>
    <style>
       .small-box input[type="text"],
.small-box input[type="number"]
 {
    border-color: cyan;
    border-radius: 20px;
    width: 200px;
    background: #191919;
    color: #1565c0;
    text-align: center;
    padding: 8px 8px;
    margin-left: auto;
    margin-right: auto;
}

    </style>

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
    </ul>
  </div>
</nav>
    <form method="post">
    <div class="container">
        <div class="small-box dark-box auto text-center" style="height:500px">
        
        <tr><h4 class="text-center text-light">Inserer le Numero d'Inscription :</h4>
        <input class="form-control" type="number" name="recherche_no" autocomplete="off">
        </tr><br>
        <tr>
        <h5 class="text-center text-light"> Inserer le Nom :</h5>
        <input class="form-control" type="text" name="recherche_nom" autocomplete="off"><br><br>
        </tr>
        <div class="d-flex justify-content-center">
                        <tr>
                            <td>
        <input class="text-center btn btn-outline-success" type="submit" name="envoyer">
                            </td>
                        </tr>
        </div>
    </div>
    </form>
    
</body>
</html>

<?php

    include 'conn.php';

    if(isset($_POST['envoyer'])){
        $stn = $_POST['recherche_nom'];
        $str = $_POST['recherche_no'];
        if($stn <> ''){
        $_stn = "%".$stn."%";}
        else{
            $_stn = $stn;
        };
        $sth = $connPDO->prepare("SELECT * FROM etudiant WHERE no_inscription = '$str' OR nom LIKE '$_stn' ");

        $sth->setFetchMode(PDO::FETCH_NUM);
        $sth->execute();

        if($ligne = $sth->fetch()){
            echo '<br><div class="alert alert-success text-center" role="alert">
                    Recherche terminé!
                    </div>';
            ?>
            <br><br><br>
            <table class="table table-hover" style="border-color: transparent;" >
                <thead>
                <tr>
                    <th>Numero d'inscription</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Sexe</th>
                    <th>Niveau</th>
                    <th>Annee</th>
                </tr>
                </thead> 
                <?php
                do {
                    echo "<tr>";
                    foreach ($ligne as $valeur){
                        echo "<td>$valeur</td>";
                    }
                    echo "</tr>";
                
                }
            while ($ligne = $sth->fetch(PDO::FETCH_NUM));
            
                ?>
            <?php
        }

        else{
             echo '<div class="alert alert-danger text-center" style="margin-top:20px;border-radius:10px;" role="alert">
                
             Numero ou Nom introuvable!
             </div>';
        }
    }
?>