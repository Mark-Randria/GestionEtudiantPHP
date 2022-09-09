<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3/bootstrap-5.1.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="font/font/css/all.css">
    <script src="bootstrap-5.1.3/bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/popper.min.js"></script>
    <title>Etudiant</title>
    <style>
</style>
</head>
<body>
    <?php
    
    include 'conn.php';

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
    
    <div class="container ">
            <div class="small-box" style="height:600px;">
            <h1 class="text-center text-light" >Etudiants</h1><br>
    <h3 class="text-center text-muted">Choisir une action :</h3><br>

    <button type="button" class="btn btn-outline-dark" style="margin:25px;" onclick="window.location.href = 'ajout_etudiant.php';">Ajout</button>
    <button type="button" class="btn btn-outline-dark" style="margin:25px;" onclick="window.location.href = 'affich_modif_etudiant.php';">Modification</button>
    <button type="button" class="btn btn-outline-dark" style="margin:25px;" onclick="window.location.href = 'affich_suppr_etudiant.php';">Suppression</button>
            </div>
    </div>



    
</body>
</html>