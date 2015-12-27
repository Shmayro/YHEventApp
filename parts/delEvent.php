<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 27/12/2015
 * Time: 16:02
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