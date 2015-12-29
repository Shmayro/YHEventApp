<?php
/**
 * Appres la verification de la session admin
 * Permet de generer un PDF d'Invitation pour un participant si on a demandé la generation de son pdf
 */
require "adminCheck.php";
require('../parts/fpdf/fpdf.php');
include("../Imports.php");
if($_GET["p"]) {
    $p=$_GET["p"];
    $part=$InscDAO->ShowInscription($p);
    if($part->pdf==1) {
        $ev = $evDAO->ShowEvent($part->idEvent);
        $np = (($part->genre == "Monsieur") ? "M. " : "Mme ") . $part->nom . " " . $part->prenom;
        $datehdebut = date_format(date_create(Securite::html($ev->datedebutEvent)), "d/m/Y H:i");
        $datehfin = date_format(date_create(Securite::html($ev->datefinEvent)), "d/m/Y H:i");

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 10, utf8_decode('Invitation'), 'RLBT', 1, "C");

        $pdf->SetFont('Arial', 'I', 16);
        $pdf->write(10, utf8_decode("\nTitre Evènement   : " . $ev->titleEvent . "\n"));
        $pdf->write(10, utf8_decode("Logo Evenèment  : " . $ev->logoEvent . "\n\n"));


        $pdf->SetFont('Arial', null, 16);
        $pdf->write(10, utf8_decode("            " . $np . "\n"));
        $pdf->Write(10, utf8_decode("Nous avons le plaisir de vous confirmer l'inscription à l'évènement " . strtoupper($ev->titleEvent) . " qui aura lieu du " . $datehdebut . " jusqu'au " . $datehfin . "."));
        $pdf->Write(10, utf8_decode("\n\nLieu : " . $ev->lieuEvent));
        $pdf->Cell(0, 50, utf8_decode("L'equipe de @YHEventApp"), 0, 1, "R");
        $pdf->Output("I", "Invitation", true);
    }
}