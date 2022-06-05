<?php
require "mesClasses/Cpdf/fpdf.php";
require_once "mesClasses/Cvisiteurs.php";
session_start();
$strConnection ='mysql:host=localhost;dbname=gsbProjet';
$arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); // demande format utf-8
$monpdo = new PDO($strConnection, 'root', '', $arrExtraParam); // Instancie la connexion
       $ovisiteur = unserialize($_SESSION['visitauth']);

class myPDF extends FPDF {

   function header() {
     //  $this->image('./img/gsb_logo2.png', 2, 1);
       $this->SetFont('Arial', 'B', 18);
       $this->Cell(276,5,'Liste des rapports', 105,0,'C');
       $this->Ln(20);
   }
   function footer(){
       $this->SetY(-15);
       $this->SetFont('Arial','',8);
       $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
   function headerTable(){
       $this->SetFont('Times','B',12);
       $this->Cell(25,10,'id rapport',1,0,'C');
       $this->Cell(25,10,'Nom',1,0,'C');
       $this->Cell(25,10,'Prenom',1,0,'C');
       $this->Cell(35,10,'Libelle',1,0,'C');
       $this->Cell(70,10,'Description',1,0,'C');
       $this->Cell(30,10,'heure de debut',1,0,'C');
       $this->Cell(30,10,'heure de fin',1,0,'C');
       $this->Cell(30,10,'Date d\'ajout',1,0,'C');
       $this->Ln();
   }
   function viewListeRapports($monpdo, $ovisiteur)
   {
       $this->SetFont('Times','',12);
       if($ovisiteur->role=="Administrateur")
       {
                  $stmt = $monpdo->query('select * from visiteursrapports order by id_rapport');
       }
       else
       {
                $stmt = $monpdo->query('select * from visiteursrapports where nom="'.$ovisiteur->nom.'" and prenom="'.$ovisiteur->prenom.'" order by id_rapport');
        }



       while($data = $stmt->fetch(PDO::FETCH_OBJ))
       {
        $this->Cell(25,10,utf8_decode($data->id_rapport),1,0,'C');
        $this->Cell(25,10,utf8_decode($data->nom),1,0,'L');
        $this->Cell(25,10,utf8_decode($data->prenom),1,0,'L');
        $this->Cell(35,10,utf8_decode($data->libelle_rapport),1,0,'L');
        
        if(strlen($data->description)>30)
        {
            $this->Cell(70,10,substr(utf8_decode($data->description), 0,30)."...",1,0,'L');
        }
        else
        {
            $this->Cell(70,10,utf8_decode($data->description),1,0,'L');
        }
        $this->Cell(30,10,utf8_decode($data->heure_debut),1,0,'L');
        $this->Cell(30,10,utf8_decode($data->heure_fin),1,0,'L');
        $this->Cell(30,10,utf8_decode($data->dateAjout),1,0,'L');
        $this->Ln();
       }
   }
}

$pdf=new myPdf();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewListeRapports($monpdo, $ovisiteur);
$pdf->Output();