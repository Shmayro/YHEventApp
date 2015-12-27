<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 26/12/2015
 * Time: 16:42
 */
include "adminCheck.php";
include_once "../Imports.php";
if(isset($_GET["EvId"])) {
    $EvId = $_GET["EvId"];
    echo ceil(count($InscDAO->ShowEventInscription($EvId)) / 20);
}
else
    echo 1;