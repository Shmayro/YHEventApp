<?php
require_once "Securite.php";

/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 26/10/15
 * Time: 15:01
 */
class Event
{
    public $idEvent;
    public $titleEvent;
    public $logoEvent;
    public $lieuEvent;
    public $lieuEventPic;
    public $datedebutEvent;
    public $datefinEvent;
    public $datedebutInsc;
    public $datefinInsc;

    public function __construct($idEvent, $titleEvent, $logoEvent, $lieuEvent, $lieuEventPic, $datedebutEvent, $datefinEvent, $datedebutInsc, $datefinInsc)
    {
        $this->idEvent = Securite::bdd($idEvent);
        $this->titleEvent = Securite::bdd($titleEvent);
        $this->logoEvent = Securite::bdd($logoEvent);
        $this->lieuEvent = Securite::bdd($lieuEvent);
        $this->lieuEventPic = Securite::bdd($lieuEventPic);
        $this->datedebutEvent = Securite::bdd($datedebutEvent);
        $this->datefinEvent = Securite::bdd($datefinEvent);
        $this->datedebutInsc = Securite::bdd($datedebutInsc);
        $this->datefinInsc = Securite::bdd($datefinInsc);
    }
}

?>