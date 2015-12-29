<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 28/12/2015
 * Time: 19:45
 */
include "adminCheck.php";
include_once "../Imports.php";
if(isset($_POST["EvId"])) {
    $EvId = $_POST["EvId"];
    $ev=$evDAO->ShowEvent($EvId);
    header('Content-Type: application/json');
    echo json_encode($ev);
}