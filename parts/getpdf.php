<?php
require('../parts/fpdf/fpdf.php');
//include('')


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,'Invitation',0,1,"C");

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'            Cher [Name] vous etes invité a assister a levenement [@]',0,1);
//$pdf->Cell(0,10,'l\'evenement commencera de [datedebut] à [datedefin]' ,0,1);
$pdf->Output("I","Invitation",true);