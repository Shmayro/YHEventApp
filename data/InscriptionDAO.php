<?php

require_once("connex.php");
require_once("Inscription.php");
require_once("EventDAO.php");


$evDAO=new EventDAO();

$ShowAllInscriptionStatement = $db->prepare("select * from Inscription");

$ShowInscriptionStatement = $db->prepare("select * from Inscription WHERE idInsc=:idInsc");
$ShowInscriptionStatement->bindParam(":idInsc", $idInsc);

$ShowInscriptionemailStatement = $db->prepare("select * from Inscription WHERE email=:email and idEvent=:idEvent");
$ShowInscriptionemailStatement->bindParam(":email", $email);
$ShowInscriptionemailStatement->bindParam(":idEvent", $idEvent);

$ShowEventInscriptionStatement = $db->prepare("select * from Inscription WHERE idEvent=:idEvent");
$ShowEventInscriptionStatement->bindParam(":idEvent", $idEvent);

$ShowEventInscriptionStatementLimited = $db->prepare("select * from Inscription WHERE idEvent=:idEvent limit :fromnumber,:nbrElem");
$ShowEventInscriptionStatementLimited->bindParam(":fromnumber", $fromnumber);
$ShowEventInscriptionStatementLimited->bindParam(":nbrElem", $nbrElem);
$ShowEventInscriptionStatementLimited->bindParam(":idEvent", $idEvent);

$deleteInscriptionStatement = $db->prepare("delete from Inscription WHERE idInsc=:idInsc");
$deleteInscriptionStatement->bindParam(":idInsc", $idInsc);

$addInscriptionStatement = $db->prepare("insert into Inscription(idEvent,genre,nom,prenom,niveauExp,email,tel,adressePost,dept,pays,repas) values (:idEvent,:genre,:nom,:prenom,:niveauExp,:email,:tel,:adressePost,:dept,:pays,:repas)");
$addInscriptionStatement->bindParam(":idEvent", $idEvent);
$addInscriptionStatement->bindParam(":genre", $genre);
$addInscriptionStatement->bindParam(":nom", $nom);
$addInscriptionStatement->bindParam(":prenom", $prenom);
$addInscriptionStatement->bindParam(":niveauExp", $niveauExp);
$addInscriptionStatement->bindParam(":email", $email);
$addInscriptionStatement->bindParam(":tel", $tel);
$addInscriptionStatement->bindParam(":adressePost", $adressePost);
$addInscriptionStatement->bindParam(":dept", $dept);
$addInscriptionStatement->bindParam(":pays", $pays);
$addInscriptionStatement->bindParam(":repas", $repas);

$updateInscriptionStatement = $db->prepare("update Inscription set idEvent=:idEvent,genre=:genre,nom=:nom,prenom=:prenom,niveauExp=:niveauExp,email=:email,tel=:tel,adressePost=:adressePost,dept=:dept,pays=:pays,repas=:repas,pdf=:pdf where idInsc=:idInsc");
$updateInscriptionStatement->bindParam(":idInsc", $idInsc);
$updateInscriptionStatement->bindParam(":idEvent", $idEvent);
$updateInscriptionStatement->bindParam(":genre", $genre);
$updateInscriptionStatement->bindParam(":nom", $nom);
$updateInscriptionStatement->bindParam(":prenom", $prenom);
$updateInscriptionStatement->bindParam(":niveauExp", $niveauExp);
$updateInscriptionStatement->bindParam(":email", $email);
$updateInscriptionStatement->bindParam(":tel", $tel);
$updateInscriptionStatement->bindParam(":adressePost", $adressePost);
$updateInscriptionStatement->bindParam(":dept", $dept);
$updateInscriptionStatement->bindParam(":pays", $pays);
$updateInscriptionStatement->bindParam(":repas", $repas);
$updateInscriptionStatement->bindParam(":pdf", $pdf);

/**
 * Class InscriptionDAO
 * offre un ensemble de fonctions qui servent a extraire et inserer des Inscriptions dans la base de données en utilisant des requètes prèparés
 */
class InscriptionDAO
{
    /**
     * retourne tout les inscriptions
     * @return array|null
     */
    public function ShowAllInscriptions()
    {
        $InscTable = null;
        global $ShowAllInscriptionStatement;
        if ($ShowAllInscriptionStatement->execute()) {
            while ($obj = $ShowAllInscriptionStatement->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas,$obj->pdf);
                $InscTable[] = $InscObj;
            }
            return $InscTable;
        }
    }

    /**
     * retourne une inscription par $id
     * @param $id
     * @return Inscription|null
     */
    public function ShowInscription($id)
    {
        global $ShowInscriptionStatement;
        global $idInsc;
        $InscObj=null;
        $idInsc = $id;
        if ($ShowInscriptionStatement->execute()) {
            while ($obj = $ShowInscriptionStatement->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas,$obj->pdf);
            }
            return $InscObj;
        }
    }

    /**
     * retourne inscription par @email, utilisé pour Verifier si une inscription existe deja dans l'ensemble des inscriptions d'un evenement avec id @idE
     * @param $emailText
     * @return Inscription|null
     */
    public function ShowInscriptionemail($idE,$emailText)
    {
        global $ShowInscriptionemailStatement;
        global $email;
        global $idEvent;

        $InscObj=null;
        $idEvent=$idE;
        $email = $emailText;
        if ($ShowInscriptionemailStatement->execute()) {
            while ($obj = $ShowInscriptionemailStatement->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas,$obj->pdf);
            }
            return $InscObj;
        }
    }

    /**
     * retourne la liste des Inscription d'un @id evenement donnée
     * @param $idE
     * @return array|null
     */
    public function ShowEventInscription($idE)
    {
        global $ShowEventInscriptionStatement;
        global $idEvent;
        $InscTable=null;
        $idEvent=$idE;
        if ($ShowEventInscriptionStatement->execute()) {
            while ($obj = $ShowEventInscriptionStatement->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas,$obj->pdf);
                $InscTable[] = $InscObj;
            }
            return $InscTable;
        }
    }

    /**
     * retourne une liste des inscriptions d'un evenment de taille $number a partir d'un index $from
     * @param $idE
     * @param $from
     * @param $number
     * @return array|null
     */
    public function ShowEventPSLimited($idE, $from, $number)
    {
        $InscTable=null;
        global $ShowEventInscriptionStatementLimited;
        global $idEvent;
        global $fromnumber;
        global $nbrElem;
        $fromnumber=$from;
        $nbrElem=$number;
        $idEvent=$idE;
        if ($ShowEventInscriptionStatementLimited->execute()) {
            while ($obj = $ShowEventInscriptionStatementLimited->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas,$obj->pdf);
                $InscTable[] = $InscObj;
            }
            return $InscTable;
        }
    }

    /**
     * Supprimer une Inscription par @id
     * @param $id
     * @return int
     */
    public function deleteInscription($id)
    {
        global $deleteInscriptionStatement;
        global $idInsc;
        $idInsc = $id;
        if ($deleteInscriptionStatement->execute()) {
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * ajouter une Inscription
     * une verfication a l'interieur de la Fonction permet de tester si la periode d'inscription et encore valide
     * @param (Inscription)$obj
     * @return int
     * 1 = Executer avec Succes (Inscription Ajoutée)
     * 0 = Ereur danns l'execution (Ajout Annulé)
     * 2 = Periode d'inscription est passée (Ajout Annulé)
     * 3 = l'Evenement de l'inscription n'existe pas (Ajout Annulé)
     */
    public function addInscription($obj)
    {
        global $addInscriptionStatement;
        global $idEvent;
        global $genre;
        global $nom;
        global $prenom;
        global $niveauExp;
        global $email;
        global $tel;
        global $adressePost;
        global $dept;
        global $pays;
        global $repas;
        global $evDAO;

        $idEvent = $obj->idEvent;
        $genre = $obj->genre;
        $nom = $obj->nom;
        $prenom = $obj->prenom;
        $niveauExp = $obj->niveauExp;
        $email = $obj->email;
        $tel = $obj->tel;
        $adressePost = $obj->adressePost;
        $dept = $obj->dept;
        $pays = $obj->pays;
        $repas = $obj->repas;

        $event=$evDAO->ShowEvent($idEvent);
        $today = date("Y-m-d H:i:s");
        $debutInsc= date_format(date_create(Securite::html($event->datedebutInsc)), "Y-m-d H:i:s");
        $finInsc= date_format(date_create(Securite::html($event->datefinInsc)), "Y-m-d H:i:s");

        if(!is_null($event)){
            if ($debutInsc <= $today && $finInsc >= $today) {
                if ($addInscriptionStatement->execute()) {
                    return 1;
                } else {
                    return 0;
                }
            }else{
                return 2;
            }
        }else{
            return 3;
        }

    }

    /**
     * @param $id
     * @param $obj
     * @return int
     */
    public function updateInscription($id, $obj)
    {
        global $updateInscriptionStatement;
        global $idEvent;
        global $idInsc;
        global $genre;
        global $nom;
        global $prenom;
        global $niveauExp;
        global $email;
        global $tel;
        global $adressePost;
        global $dept;
        global $pays;
        global $repas;
        global $pdf;

        $idInsc = $id;

        $idEvent = $obj->idEvent;
        $genre = $obj->genre;
        $nom = $obj->nom;
        $prenom = $obj->prenom;
        $niveauExp = $obj->niveauExp;
        $email = $obj->email;
        $tel = $obj->tel;
        $adressePost = $obj->adressePost;
        $dept = $obj->dept;
        $pays = $obj->pays;
        $repas = $obj->repas;
        $pdf=$obj->pdf;

        if ($updateInscriptionStatement->execute()) {
            return 1;
        } else {
            return 0;
        }

    }
}

//$ev = new InscriptionDAO();
//echo "reussi";
//print_r($ev->ShowEventPSLimited(1,0,20));
/*print_r($ev->ShowAllInscriptions());
echo "shiit\n";
$test=new Inscription(1, 3, 3, 3, 3, 3, 3,3,3,3,3,"@01000@");
echo $ev->addInscription($test);
echo $ev->updateInscription(1,new Inscription(1, 3, 3, 3, 3, 3, 3,3,3,3,3,"@111@"));
echo "shiit\n";
print_r($ev->ShowInscription(1));*/


