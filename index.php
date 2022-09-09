<!DOCTYPE html>
<html>
    <head>
        <title>Page D'accueil</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Gestion des notes</title>
        <link rel="stylesheet" href="font/font/css/all.css">
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap-5.1.3/bootstrap-5.1.3/dist/css/bootstrap.min.css"/>
        <script src="bootstrap-5.1.3/bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
        <script src="bootstrap-5.1.3/jquery/jquery-3.6.0.min.js"></script>
        <script src="bootstrap-5.1.3/jquery/popper.min.js"></script>
        
    </head>
    
    <body>
      <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Marque anle accueil -->
          <a class="navbar-brand fa fa-home fa-fw" style="margin-left: 20px;" href="index.php"></a><i class="text-light text-center" style="margin-left: -5px;"></i>

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

        
   
        <?php

            /*Connection aza adino */

            include 'conn.php';

        ?>
        
    <br>
    <br>
    <h3 class="text-center">Gestions des notes des Etudiants</h3>  
        <div class="container">
          <div class="small-box dark-box mx auto text-center">
                            <h1 class="text-center text-light">Bienvenue</h1>
                            <p class="text-muted">Veuillez sélectionner une action : </p>
                            <div class="col-md-12">
            
                <button type="button" class="btn btn-outline-light" style="margin:25px;" onclick="window.location.href = 'etudiant.php';">Etudiants</button>
                <button type="button" class="btn btn-outline-light" style="margin:25px;"onclick="window.location.href = 'matiere.php';">Matières</button>
                <button type="button" class="btn btn-outline-light" style="margin:25px;" onclick="window.location.href = 'notes.php';">Notes</button>
            
    <br>
            
                <button type="button" class="btn btn-outline-light" style="margin:20px;"onclick="window.location.href = 'rechercher.php';">Recherche Etudiants</button>
                <button type="button" class="btn btn-outline-light" style="margin:20px;"onclick="window.location.href = 'effectif_niveau.php';">Effectifs des Etudiants</button>
                <button type="button" class="btn btn-outline-light" style="margin:20px;" onclick="window.location.href = 'affich_bulletin.php';">Bulletins des Etudiants</button></td>
                            </div>
            </div>
        </div>

    </body>
</html>