<?php
require_once "Securite.php";


/**
 * Classe Event
 */
class Event
{
    /**
     * id de l'evenement
     * @var int
     */
    public $idEvent;
    /**
     * titre de l'evenement
     * @var string
     */
    public $titleEvent;
    /**
     * logo de l'evenement
     * @var string
     */
    public $logoEvent;
    /**
     * lieu de l'evenement
     * @var string
     */
    public $lieuEvent;
    /**
     * photo du lieu d'evenement
     * @var string
     */
    public $lieuEventPic;
    /**
     * date-heure debut de l'evenement
     * @var DateTime
     */
    public $datedebutEvent;
    /**
     * date-heure fin de l'evenement
     * @var DateTime
     */
    public $datefinEvent;
    /**
     * date-heure debut a l'inscription de l'evenement
     * @var DateTime
     */
    public $datedebutInsc;
    /**
     * date-heure fin a l'inscription de l'evenement
     * @var DateTime
     */
    public $datefinInsc;

    /**
     * Event constructor.
     * @param $idEvent
     * @param $titleEvent
     * @param $logoEvent
     * @param $lieuEvent
     * @param $lieuEventPic
     * @param $datedebutEvent
     * @param $datefinEvent
     * @param $datedebutInsc
     * @param $datefinInsc
     */
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