<?php
require_once "Securite.php";

/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 26/10/15
 * Time: 15:01
 */
class Repas
{
    public $idInsc;
    public $dateRepas;

    public function __construct($idEvent, $dateRepas){
            $this->idEvent = Securite::bdd($idEvent);
            $this->dateRepas = Securite::bdd($dateRepas);
    }
}

?>