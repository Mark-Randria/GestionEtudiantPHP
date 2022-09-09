<?php

$connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes', 'root', '');
$connPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once ('fpdf184/fpdf.php');
if($pdf = new FPDF())
{
    
    $pdf->AddPage();
    $pdf->SetFont("Arial","BU",16);
    $pdf->Cell(150,10,"Bulletin",0,1,'C');
    
    if(isset($_GET['no_inscription'])&&isset($_GET['nom'])&&isset($_GET['niveau'])&&isset($_GET['annee'])&&isset($_GET['moyenne'])&&isset($_GET['observation'])&&isset($_GET['moyenne_classe']))
    {
        $no_inscription=$_GET['no_inscription'];
        $nom=$_GET['nom'];
        $niveau=$_GET['niveau'];
        $annee=$_GET['annee'];
        $moyenne=$_GET['moyenne'];
        $observation=$_GET['observation'];
        $moyenne_classe=$_GET['moyenne_classe'];
        $format_moyenne = round($moyenne , 2);


        $pdf->SetFont("Arial","BU",10);
        $pdf->Cell(50,10,utf8_decode('N°ETUDIANT:'),0,0,'L');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,10,$no_inscription,0,1,'L');
        $pdf->SetFont("Arial","BU",10);
        $pdf->Cell(50,10,utf8_decode('NOM:'),0,0,'L');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,10,$nom,0,0,'L');
        $pdf->SetFont("Arial","BU",10);
        $pdf->Cell(50,10,utf8_decode('NIVEAU:'),0,0,'L');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,10,$niveau,0,1,'L');
        $pdf->SetFont("Arial","BU",10);
        $pdf->Cell(50,10,utf8_decode('ANNEE:'),0,0,'L');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(50,10,$annee,0,1,'L');

       
        
$requete="select notes.note,matiere.libelle,matiere.coef,notes.note*matiere.coef as notepondere from etudiant,notes,matiere where etudiant.no_inscription=notes.no_inscription and notes.codemat=matiere.codemat and etudiant.no_inscription='$no_inscription'";
$result=$connPDO->query($requete);
if($result)
{ 
    $data=$result->fetch(PDO::FETCH_ASSOC);
    if($data)
    { 


            $pdf->SetFont("Arial","B",10);
            $pdf->Cell(40,10,"DESIGNATION",1,0,'C');
            $pdf->Cell(40,10,"COEF",1,0,'C');
            $pdf->Cell(40,10,"NOTE",1,0,'C');
            $pdf->Cell(40,10,"NOTE PONDERE",1,1,'C');
            do
         {
            $pdf->Cell(40,10,utf8_decode($data["libelle"]),1,0,'C');
            $pdf->Cell(40,10,utf8_decode($data["coef"]),1,0,'C');
            $pdf->Cell(40,10,utf8_decode($data["note"]),1,0,'C');
            $pdf->Cell(40,10,utf8_decode($data["notepondere"]),1,1,'C');
         }while ($data = $result->fetch(PDO::FETCH_ASSOC));
            
    }

}

        $pdf->Cell(40,10,utf8_decode(' '),0,0,'C');
        $pdf->Cell(40,10,utf8_decode(' '),0,0,'C');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(40,10,'MOYENNE',1,0,'C');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(40,10,$format_moyenne,1,1,'C');
        $pdf->Cell(40,10,utf8_decode(' '),0,0,'C');
        $pdf->Cell(40,10,utf8_decode(' '),0,0,'C');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(40,10,utf8_decode('OBSERVATION'),1,0,'C');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(40,10,$observation,1,1,'C');
        $pdf->Cell(40,10,utf8_decode(' '),0,1,'C');
        $pdf->Cell(40,10,utf8_decode(' '),0,0,'C');
        $pdf->SetFont("Arial","BU",10);
        $pdf->Cell(40,10,utf8_decode('MOYENNE DE CLASSE'),0,0,'C');
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(40,10,$moyenne_classe,0,1,'C');



    }
    $pdf->Output();
}
else{die();}
?>