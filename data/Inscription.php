<?php
require_once "Securite.php";


/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 26/10/15
 * Time: 15:01
 */
class Inscription
{
    public $idEvent;
    public $idInsc;
    public $genre;
    public $nom;
    public $prenom;
    public $niveauExp;
    public $email;
    public $tel;
    public $adressePost;
    public $dept;
    public $pays;
    public $repas;

    public function __construct($idEvent, $idInsc, $genre, $nom, $prenom, $niveauExp, $email,$tel,$adressePost,$dept,$pays,$repas)
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
    }

}

?>