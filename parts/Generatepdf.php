<?php
/**
 * apres la verification de la session admin
 *
 * Permet d'acctiver la generation de pdf pour les Participant
 *
 * On a deux Cas :
 *
 * si On recoit $_GET["evid"] selement on avtive la generation du pdf pour tout les participant du Evenement avec l'id $_GET["evid"]
 * si on recoit $_GET["p"] et $_GET["evid"] on active le pdf que pour le participant avec l'id $_GET["p"] inscrit a l'evenement avec l'id $_GET["evid"]
 *
 */
include "adminCheck.php";
include "../Imports.php";
if(isset($_GET["p"])){
    //modification pour un inscrit de l'event
    $p=$_GET["p"];
    $pobj=$InscDAO->ShowInscription($p);
    $pobj->pdf=1;
    $InscDAO->updateInscription($p,$pobj);
}else{
    if(isset($_GET["evid"])){
        //modification de tout les inscrits du event
        $evid=$_GET["evid"];
        $ps=$InscDAO->ShowEventInscription($evid);
        foreach($ps as $p){
            $p->pdf=1;
            $InscDAO->updateInscription($p->idInsc,$p);
        }
    }
}