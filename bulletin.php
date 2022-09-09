
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Bulletin</title>
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
      <a class="nav-link" style="margin-left: 20px;" href="affich_bulletin.php">Liste des étudiants</a>
    </li>
    </ul>
  </div>
</nav>
    <div class="container col-md-6">
        <div class="data">
            <div class="table-responsive">
                <div class="col-md-12">
                    <br>
                    <h3 class="text-center">BULLETIN</h3>
                    <br>
                </div>
                <?php
                $connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes', 'root', '');
                $connPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $no_inscription=$_GET['no_inscription'];
                $niveau = $_GET['niveau'];

                $requete="select notes.note,matiere.libelle,matiere.coef,notes.note*matiere.coef as notepondere,etudiant.no_inscription,etudiant.nom,etudiant.niveau,etudiant.annee,sum(notes.note*matiere.coef)/sum(matiere.coef) as moyenne,case  when sum(notes.note*matiere.coef)/sum(matiere.coef) >=10 then 'admis' when sum(notes.note*matiere.coef)/sum(matiere.coef)>=7.5 then 'redoublant' else 'exclus' end as observation from etudiant,notes,matiere where etudiant.no_inscription=notes.no_inscription and notes.codemat=matiere.codemat and etudiant.no_inscription='$no_inscription'";
                $result=$connPDO->query($requete);
                if($result->rowCount() > 0)
                    { 
                        $data = $result->fetch();
                        
                            
                                $numero=$data['no_inscription'];
                                $nom=$data['nom'];
                                $niveau=$data['niveau'];
                                $annee=$data['annee'];
                        
                            echo " N°INCRIPTION : ".$numero."<br> NOM : ".$nom."<br> NIVEAU : ".$niveau."<br> ANNEE : ".$annee;                             
                            $result->closeCursor();
                            $requete1="select notes.note,matiere.libelle,matiere.coef,notes.note*matiere.coef as notepondere from etudiant,notes,matiere where etudiant.no_inscription=notes.no_inscription and notes.codemat=matiere.codemat and etudiant.no_inscription='$no_inscription'";
                            $result1=$connPDO->query($requete1);
                            if($result1->rowCount() > 0)
                        { 
                                if($result1)
                                { 
                                    $data1=$result1->fetch(PDO::FETCH_ASSOC);
                                    if($data1)
                                        { ?>
                                    <table class="table table-bordered" style="border-color:black">
                                        <tr>
                                            <th scope="col" class="text-center">DESIGNATION</th>
                                            <th scope="col" class="text-center">COEF</th>
                                            <th scope="col" class="text-center">NOTE</th>
                                            <th scope="col" class="text-center">NOTE PONDEREE</th>                                
                                        </tr>
                                
                                    <?php


                                        do{
                                            echo "<tr>";
                                                echo "<td>" . $data1['libelle'] . "</td>";
                                                echo "<td>" . $data1['coef'] . "</td>";
                                                echo "<td>" . $data1['note'] . "</td>";
                                                echo "<td>" . $data1['notepondere']. "</td>";
                                            echo "</tr>";
                                            
                                            
                                        } while($data1 = $result1->fetch(PDO::FETCH_ASSOC));
                                        ?><?php
                                                
                                        $moyenne=$data['moyenne'];
                                        $format_moyenne = round($moyenne, 2);
                                        $observation=$data['observation']; 
                                        echo "<tr>";
                                            echo '<td colspan="2"></td>';
                                            echo "<th>MOYENNE</th>";
                                            echo "<td>".$format_moyenne."</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo '<td colspan="2"></td>';
                                            echo "<th>OBSERVATION</th>";
                                            echo "<td>".$observation."</td>";
                                        echo "</tr>";
                                echo "</table>";
                                      }
                                    }
                                }
                                    else
                                        {
                                            ?>
                                            <h2 class="text-center">Aucun bulletin n'a été trouvé</h2>
                                            <?php
                                                    ;
                                        }
                                        ?>
                                        <br><h3 class="text-center">Classement des Etudiants au niveau <?=$niveau?> </h3>
                                        <?php
                            $result1->closeCursor();
                            $requete2 = "select etudiant.no_inscription,etudiant.nom,sum(notes.note*matiere.coef)/sum(matiere.coef) as moyenne,case  when sum(notes.note*matiere.coef)/sum(matiere.coef) >=10 then 'admis' when sum(notes.note*matiere.coef)/sum(matiere.coef)>=7.5 then 'redoublant' else 'exclus' end as observation from etudiant,notes,matiere where etudiant.no_inscription=notes.no_inscription and notes.codemat=matiere.codemat and etudiant.niveau='$niveau' group by etudiant.no_inscription order by moyenne desc";
                            $result2 = $connPDO->query($requete2);
                            if($result2->rowCount() > 0)
                        { 
                                if($result2)
                                { 
                                    $data2=$result2->fetch(PDO::FETCH_ASSOC);
                                    if($data2)
                                    {?>
                                        <table class="table table-bordered" style="border-color:black">
                                        <tr>
                                            <th scope="col" class="text-center">NO ETUDIANT</th>
                                            <th scope="col" class="text-center">NOM</th>
                                            <th scope="col" class="text-center">MOYENNE</th>                               
                                        </tr>
                                        <?php
                                         do{
                                            echo "<tr>";
                                                echo "<td>" . $data2['no_inscription'] . "</td>";
                                                echo "<td>" . $data2['nom'] . "</td>";
                                                echo "<td>" . $moyenne_arrondi= round($data2['moyenne'], 2) . "</td>";
                                            echo "</tr>";
                                            
                                            
                                            
                                        } while($data2 = $result2->fetch(PDO::FETCH_ASSOC));
                                        ?><?php
                                    }
                                }
                        }
                        $result2->closeCursor();
                        $requete3 = "select etudiant.no_inscription,etudiant.nom,sum(notes.note*matiere.coef)/sum(matiere.coef) as moyenne from etudiant,notes,matiere where etudiant.no_inscription=notes.no_inscription and notes.codemat=matiere.codemat and etudiant.niveau='$niveau' group by no_inscription with rollup";
                        $result3 = $connPDO->query($requete3);
                        if($result3->rowCount() > 0)
                        {
                            if($result3)
                            {
                                $data3=$result3->fetch(PDO::FETCH_NUM);
                                if($data3)
                                {?>
                                <table class="table table-bordered" style="border-color:transparent;">
                                        <tr>
                                            <td scope="col" colspan="3" class="text-center" style="text-decoration:underline">MOYENNE de classe du niveau <?=$niveau?> :</td>                               
            
                                        <?php
                        $total = 0;
                        while($data3 = $result3->fetch(PDO::FETCH_NUM)){
                            $total = $data3[2];}
                                echo "<td class='text-center'>" . $moyenne_classe = round($total, 2) . "";
                            echo "</tr>";
                            echo '<div class="d-flex justify-content-center"> 
                            <button type="submit" class="fa-regular fa-file-pdf fa-1x" style="background:transparent;"><a href="pdf.php?no_inscription='.$no_inscription.'&nom='.$nom.'&niveau='.$niveau.'&annee='.$annee.'&moyenne='.$moyenne.'&observation='.$observation.'&moyenne_classe='.$moyenne_classe.'" class="text-dark" style="margin-left:10px">pdf</a></button>
                            </div>';
                                            

                                } 
                            }
                        }
                    }
                    else
                        {
                            echo "Aucun bulletin n'a été trouvé";
                        }
                    
                ?>
            </div> 
        </div>
    </div>           
    </body>
</html>