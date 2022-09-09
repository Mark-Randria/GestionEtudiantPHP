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
        <?php
        //connection a la BDD
        $connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes','root', '');
        $connPDO ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = "SELECT niveau, count(no_inscription) AS effectif FROM etudiant GROUP BY niveau ";
        $result = $connPDO->query($requete);

        if (!$result){
            echo 'erreur pendant la recuperation des donnees';
        }else{
            $nbre_etudiant = $result->rowCount();
        }
        ?>
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
        <br><h3 class="text-center" style="font-family: var(--bs-body-font-family);">Effectif des Etudiants par niveau</h3>
        <table class="table table-hover" style="border-color: transparent;font-family: var(--bs-body-font-family);">
            <thead>
            <tr>
                <th>Niveau</th>
                <th>Effectifs</th>
                <th>Listes</th>
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
                    <a href="affich_effectif_niveau.php?niveau=<?=$ligne[0]?>">Afficher</a>           
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