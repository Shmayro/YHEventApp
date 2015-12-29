<?php
/**
 * Apres une verfication de la session admin.
 *
 * Sert a Supprimer un evenement avec tout ses Inscription
 */
include "adminCheck.php";
include "../Imports.php";
if (isset($_POST["EvId"])){
    $idEv=$_POST["EvId"];
    $einscs=$InscDAO->ShowEventInscription($idEv);
    foreach((array)$einscs as $item){
        $InscDAO->deleteInscription($item->idInsc);
    }
    $evDAO->deleteEvent($idEv);
}