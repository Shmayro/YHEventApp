<?php

require_once "Securite.php";

/**
 * Class Inscription
 */
class Inscription
{
    /**
     * id de l'evenement
     * @var int
     */
    public $idEvent;
    /**
     * id d'inscription
     * @var int
     */
    public $idInsc;
    /**
     * genre ('Monsieur','Madame')
     * @var string
     */
    public $genre;
    /**
     * nom
     * @var string
     */
    public $nom;
    /**
     * prenom
     * @var string
     */
    public $prenom;
    /**
     * Niveau d'experiance('Débutant','Confirmé','Expert')
     * @var string
     */
    public $niveauExp;
    /**
     * email
     * @var string
     */
    public $email;
    /**
     * tel
     * @var string
     */
    public $tel;
    /**
     * Adresse postal
     * @var string
     */
    public $adressePost;
    /**
     * departement
     * @var string
     */
    public $dept;
    /**
     * pays
     * @var string
     */
    public $pays;
    /**
     * designe l'ensemble des repas (chaine de caractaire ou chaque caractaire designe une journée de l'evenement) <br/>
     * 1 = un repas <br/>
     * 0 = pas de repas <br/>
     * @var string
     */
    public $repas;
    /**
     * pdf a generer ou pas <br/>
     * 1 = a generer  <br/>
     * 0 = ne pas generer  <br/>
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