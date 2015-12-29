<?php
/**
 * apres verification de la session admin
 * permet de retouner un objet Evenement demandé sous format json
 * (utilisé pour la modification d'events)
 */
include "adminCheck.php";
include_once "../Imports.php";
if(isset($_POST["EvId"])) {
    $EvId = $_POST["EvId"];
    $ev=$evDAO->ShowEvent($EvId);
    header('Content-Type: application/json');
    echo json_encode($ev);
}