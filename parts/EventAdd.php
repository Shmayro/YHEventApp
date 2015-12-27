<?php
/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 23/12/15
 * Time: 06:07
 */
include "adminCheck.php";
include "../Imports.php";
if (isset($_POST["titleEvent"]) && isset($_POST["logoEvent"]) && isset($_POST["lieuEvent"]) && isset($_POST["imgEvent"]) && isset($_POST["datedebutInsc"]) && isset($_POST["datefinInsc"]) && isset($_POST["datedebutEvent"]) && isset($_POST["datefinEvent"])){
    $titleEvent=$_POST["titleEvent"];
    $logoEvent=$_POST["logoEvent"];
    $lieuEvent=$_POST["lieuEvent"];
    $imgEvent=$_POST["imgEvent"];
    $datedebutInsc=$_POST["datedebutInsc"];
    $datefinInsc=$_POST["datefinInsc"];
    $datedebutEvent=$_POST["datedebutEvent"];
    $datefinEvent=$_POST["datefinEvent"];

    $EvObj=new Event(0,$titleEvent,$logoEvent,$lieuEvent,$imgEvent,$datedebutEvent,$datefinEvent,$datedebutInsc,$datefinInsc);

    $etatEV=$evDAO->addEvent($EvObj);

        if($etatEV==1){
        ?><div id='confirmsg' class="alert alert-success" role="alert">Ajout Accéptée !!</div><?php
    }else{
        ?><div id='confirmsg' class="alert alert-danger" role="alert">Erreur !! ,Ajout Annulée</div><?php
    }}else{

    ?><div id='confirmsg' class="alert alert-warning" role="alert">Formulaire Incomplet, Ajout Annulée</div><?php }

?>