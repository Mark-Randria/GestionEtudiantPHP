<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
      <a class="nav-link" style="margin-left: 20px;" href="effectif_niveau.php">Effectif</a>
    </li>
    </ul>
  </div>
</nav>
        <?php
        //connection a la BDD
        $connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes','root', '');
        $connPDO ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $niveau = $_GET['niveau'];

        $requete = ("SELECT * FROM etudiant WHERE niveau='$niveau'");
        $result = $connPDO->query($requete);

        if (!$result){
            echo 'erreur pendant la recuperation des donnees';
        }else{
            $nbre_etudiant = $result->rowCount();
        }
        ?><br>
        <h3 class="text-center" style="font-family: var(--bs-body-font-family);">Tous les Etudiants au niveau <?=$niveau?></h3><br>
        <h4 style="font-family: var(--bs-body-font-family);">Il y a <?=$nbre_etudiant?> Etudiants enregistrés au niveau <?=$niveau?></h4>
        <table class="table table-hover" style="border-color:transparent;font-family: var(--bs-body-font-family);">
            <thead>
            <tr>
                <th>Numero d'Inscription</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Sexe</th>
                <th>Niveau</th>
                <th>Annee</th>
            </tr>
            </thead>

            <?php
            while ($ligne = $result->fetch(PDO::FETCH_NUM)){
               echo "<tr>";
                foreach ($ligne as $valeur){
                    echo "<td>$valeur</td>";
                }
                ?>
                <td>
                              
                </td>
                <?php
                echo "</tr>";
            }
            ?>
        </table>
        <?php
        $result->closeCursor();
        ?>
    
</body>
</html>