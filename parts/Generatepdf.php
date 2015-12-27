<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 27/12/2015
 * Time: 00:02
 */
include "adminCheck.php";
include "../Imports.php";
if(isset($_GET["p"])){
    $p=$_GET["p"];
    $pobj=$InscDAO->ShowInscription($p);
    $pobj->pdf=1;
    $InscDAO->updateInscription($p,$pobj);
}else{
    if(isset($_GET["evid"])){
        $evid=$_GET["evid"];
        $ps=$InscDAO->ShowEventInscription($evid);
        foreach($ps as $p){
            $p->pdf=1;
            $InscDAO->updateInscription($p->idInsc,$p);
        }
    }
}