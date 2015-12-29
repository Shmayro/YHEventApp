<?php
/**
 * Ajouter un evenement ou le modifie apres verfication de la session admin
 *
 * recupère les données d'un formulaire insert ou modifie un evenement selon d'existance de la valeur [idEvent]
 *
 * Affiche aussi un message retourné lors de son appele
 */
include "adminCheck.php";
include "../Imports.php";

//verifier si le formulaire est bien saisie
if (isset($_POST["titleEvent"]) && isset($_POST["logoEvent"]) && isset($_POST["lieuEvent"]) && isset($_POST["imgEvent"]) && isset($_POST["datedebutInsc"]) && isset($_POST["datefinInsc"]) && isset($_POST["datedebutEvent"]) && isset($_POST["datefinEvent"])){
    //Bien saisie
    //recuperation des données
    $titleEvent=$_POST["titleEvent"];
    $logoEvent=$_POST["logoEvent"];
    $lieuEvent=$_POST["lieuEvent"];
    $imgEvent=$_POST["imgEvent"];
    $datedebutInsc=$_POST["datedebutInsc"];
    $datefinInsc=$_POST["datefinInsc"];
    $datedebutEvent=$_POST["datedebutEvent"];
    $datefinEvent=$_POST["datefinEvent"];

    //creation objet Event
    $EvObj=new Event(0,$titleEvent,$logoEvent,$lieuEvent,$imgEvent,$datedebutEvent,$datefinEvent,$datedebutInsc,$datefinInsc);

    //message a afficher
    $msgtype="Ajout";

    //etat de l'execution de la requete
    $etatEV=null;

    if(isset($_POST["idEv"])){
        //recupere la valeur envoyée ["idEv"] par le formulaire
        $numev=$_POST["idEv"];
        if($numev==""){
            //Ajout d'un nouveau Event
            $etatEV=$evDAO->addEvent($EvObj);
        }else {
            //Modifcation du Event
            $msgtype = "Modification";
            $etatEV = $evDAO->updateEvent($numev, $EvObj);
        }
    }
    else {
        //Ajout d'un nouveau Event
        $etatEV = $evDAO->addEvent($EvObj);
    }
        //Succée d'execution
        if($etatEV==1){
        ?><div id='confirmsg' class="alert alert-success" role="alert"><?php echo $msgtype; ?> Accéptée !!</div><?php
    }else{
            //Erreur d'execution
        ?><div id='confirmsg' class="alert alert-danger" role="alert">Erreur !! ,<?php echo $msgtype; ?> Annulée</div><?php
    }}else{
        //Formulaire incomplet
    ?><div id='confirmsg' class="alert alert-warning" role="alert">Formulaire Incomplet, <?php echo $msgtype; ?> Annulée</div><?php }

?>