<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'une Notes</title>
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
      <a class="nav-link" style="margin-left: 20px;" href="notes.php">Notes</a>
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
$no_inscription = $_GET['no_inscription'];

$requete = "SELECT * fROM notes WHERE (codemat='$codemat' AND no_inscription='$no_inscription')";

$result = $connPDO->query($requete);

//recuperation des donnees en tableau associatif (PDO::FETCH_ASSOC)
$data = $result->fetch(PDO::FETCH_ASSOC);


?>

<form action="modif_notes.php" method="post">
<div class="container">
        <div class="small-box dark-box auto text-center" style="height:550px">
            <div class="col-md-12">
                <h3 class="text-center text-light">
                Modification des notes
                </h3>
                <br>
            </div>

        <table class="mb-5">
        <tr>
                <td class="text-light">Codemat : </td>
                <td>
                <input class="form-control" type="text" name="nom" size="50" value="<?=$data['codemat']?>" readonly>
                </td>            
            </tr>
            <tr>
                <td class="text-light">Numero d'Inscription : </td>
                <td>
                <input class="form-control" type="text" name="nom" size="50" value="<?=$data['no_inscription']?>" readonly>
                </td>            
            </tr>
            <tr>
                <td class="text-light">Niveau : </td>
                <td>
                <select name="niveau" class="form-control">
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="L3">L3</option>
                                    <option value="M1">M1</option>
                                    <option value="M2">M2</option>
                            </select>
                </td>            
            </tr>
            <tr>
                <td class="text-light">Coefficient : </td>
                <td>
                <input class="form-control" type="number" name="note" size="50" value="<?=$data['note']?>">
                </td>            
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
    <input type="hidden" name="codemat" value="<?=$codemat?>">
    <input type="hidden" name="no_inscription" value="<?=$no_inscription?>">
                        

</form>
        <?php

         $result->closeCursor();

        }else if(isset($_POST['niveau']) && isset($_POST['note'])){

            $niveau = $_POST['niveau'];
            $note = $_POST['note'];
            $codemat = $_POST['codemat'];
            $no_inscription = $_POST['no_inscription'];

            $requete = $connPDO->prepare("UPDATE notes set codemat='$codemat', no_inscription='$no_inscription', niveau='$niveau', note='$note' where (codemat='$codemat' and no_inscription='$no_inscription')");
            
                $requete->bindValue(':niveau', $niveau);
                $requete->bindValue(':note', $note);
                $requete->bindValue(':codemat', $codemat);
                $requete->bindValue(':no_inscription', $no_inscription);

                $result = $requete->execute();

                if(!$result){
                    echo "Un problème a été detecte, les modifications n'ont pas été faites!";
                }else{
                    echo '<div class="alert alert-success" role="alert">
                    Vos modifications on été enregistrés
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