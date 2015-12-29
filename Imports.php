<?php
//Imports

$cryptingKey="HarounShmayroYesWeCan";
$serveradr="//".$_SERVER['HTTP_HOST']."/YHEventApp/";
date_default_timezone_set('UTC');
include "data/InscriptionDAO.php";
$InscDAO=new InscriptionDAO();

//print_r($evDAO->ShowAllEvents());
