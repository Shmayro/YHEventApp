<?php

require_once "Securite.php";

/**
 * Class Inscription
 */
class Inscription
{
    /**
     * @var int
     */
    public $idEvent;
    /**
     * @var int
     */
    public $idInsc;
    /**
     * @var string
     */
    public $genre;
    /**
     * genre ('Monsieur','Madame')
     * @var string
     */
    public $nom;
    /**
     * @var string
     */
    public $prenom;
    /**
     * @var string
     */
    public $niveauExp;
    /**
     * Niveau d'experiance('Débutant','Confirmé','Expert')
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $tel;
    /**
     * @var string
     */
    public $adressePost;
    /**
     * @var string
     */
    public $dept;
    /**
     * @var string
     */
    public $pays;
    /**
     * designe l'ensemble des repas (chaine de caractaire ou chaque caractaire designe une journée de l'evenement)
     * 1 = un repas
     * 0 = pas de repas
     * @var string
     */
    public $repas;
    /**
     * @var string
     */
    public $pdf;

    /**
     * Inscription constructor.
     * @param $idEvent
     * @param $idInsc
     * @param $genre
     * @param $nom
     * @param $prenom
     * @param $niveauExp
     * @param $email
     * @param $tel
     * @param $adressePost
     * @param $dept
     * @param $pays
     * @param $repas
     * @param $pdf
     */
    public function __construct($idEvent, $idInsc, $genre, $nom, $prenom, $niveauExp, $email, $tel, $adressePost, $dept, $pays, $repas, $pdf)
    {
        $this->idEvent = Securite::bdd($idEvent);
        $this->idInsc = Securite::bdd($idInsc);
        $this->genre = Securite::bdd($genre);
        $this->nom = Securite::bdd($nom);
        $this->prenom = Securite::bdd($prenom);
        $this->niveauExp = Securite::bdd($niveauExp);
        $this->email = Securite::bdd($email);
        $this->tel = Securite::bdd($tel);
        $this->adressePost = Securite::bdd($adressePost);
        $this->dept = Securite::bdd($dept);
        $this->pays = Securite::bdd($pays);
        $this->repas = Securite::bdd($repas);
        $this->pdf = Securite::bdd($pdf);
    }

}

?>