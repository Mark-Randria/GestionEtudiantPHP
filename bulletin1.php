<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletin d'un Etudiant</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/bootstrap-5.1.3/dist/css/bootstrap.min.css"/>
    <script src="bootstrap-5.1.3/bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.1.3/jquery/popper.min.js"></script>
</head>
<body>
        <input type="button" onclick="window.location.href = 'affich_bulletin.php';" value="Retour">
        <?php
    
    $connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes', 'root', '');
    $connPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    
    
    
    //utilisation de GET a lieu de POST car no_inscription a ete tranfere par URL
    $no_inscription = $_GET['no_inscription'];
    
    $requete1 =("SELECT notes.note, matiere.libelle, matiere.coef, notes.note*matiere.coef as note_pondere, etudiant.no_inscription, etudiant.nom, etudiant.niveau, etudiant.annee, sum(notes.note*matiere.coef) as moyenne, case when sum(notes.note*matiere.coef)/sum(matiere.coef) >=10 then 'admis' when sum(notes.note*matiere.coef)>=7.5 then 'redoublant' else 'exclus' end as observation from etudiant, notes, matiere where etudiant.no_inscription=notes.no_inscription and notes.codemat=matiere.codemat and etudiant.no_inscription=\"$no_inscription\" ;"); 
    $requete = ("SELECT t1.nom, t1. FROM etudiant t1 INNER JOIN notes t2 ON t1.no_inscription=t2.no_inscription INNER JOIN matiere t3 ON t2.codemat=t3.codemat WHERE t1.no_inscription = '$no_inscription';");
    
    
    $result = $connPDO->query($requete);
    
    if($result->rowCount() > 0){
        $data = $result->fetch();
        
        ?>
         <form action="bulletin.php" method="post">
      
      <div class="container">
          <h1>
              Bulletin
          </h1>
          <div class="center-block"

      <tr>
              <td>Numero d'Etudiant : </td>
              <td>
              <?=$no_inscription?>
              </td>            
          </tr><br>
          <tr>
              <td>Nom : </td>
              <td>
              <?=$data['nom']?>
              </td>            
          </tr>
          <tr>
              <td>Niveau : </td>
              <td>
                            <?=$data['niveau']?>
              </td>            
          </tr><br>
          <tr>
          <tr><td>Annee :

          </td><td>
              <?=$data['annee']?>   
          </tr>
          </div>
      </div>

      <table class="table table-bordered">
          <tr>
              <th>DESIGNATION</th>
              <th>COEF</th>
              <th>NOTE</th>
              <th>NOTE PONDEREE </th>
          </tr>
        <?php
        $sum = 0;
        
       do{
            echo "<tr>";
                echo "<td>" . $data['libelle'] . "</td>";
                echo "<td>" . $data['coef'] . "</td>";
                echo "<td>" . $data['note'] . "</td>";
                echo "<td>" . $notepondere = $data['coef'] * $data['note']. "</td>";
            echo "</tr>";
            
            
        } while($data = $result->fetch(PDO::FETCH_ASSOC));

        echo "<tr>";
                echo '<td colspan="2"></td>';
                echo "<th>MOYENNE</th>";
                echo "<td>".$moyenne1 = $moyenne."</td>";
            echo "</tr>";
        echo "</table>";
        $result->closeCursor();
    } else{
        echo "Aucun resultat trouve correspondant a vos recherche.";
    }

    
    ?> 
            </table>
                              
        <input type="hidden" name="no_inscription" value="<?=$no_inscription?>">
    </form>
            <?php
    
             
                        
                    
            
               
            ?>

           
</body>
</html>