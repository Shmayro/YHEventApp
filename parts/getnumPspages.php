<?php
/**
 * Apres la verfication de la session admin
 * permet de retourner le nombre de page des inscrit dans un evenement donné par son id
 * 20 participants par page
 */
include "adminCheck.php";
include_once "../Imports.php";
if(isset($_GET["EvId"])) {
    $EvId = $_GET["EvId"];
    echo ceil(count($InscDAO->ShowEventInscription($EvId)) / 20);
}
else
    echo 1;