<?php

require_once("connex.php");
require_once("Inscription.php");
require_once("EventDAO.php");
/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 26/10/15
 * Time: 15:08
 */
$evDAO=new EventDAO();

$ShowAllInscriptionStatement = $db->prepare("select * from Inscription");

$ShowInscriptionStatement = $db->prepare("select * from Inscription WHERE idInsc=:idInsc");
$ShowInscriptionStatement->bindParam(":idInsc", $idInsc);

$ShowEventInscriptionStatement = $db->prepare("select * from Inscription WHERE idInsc=:idInsc AND idEvent=:idEvent");
$ShowEventInscriptionStatement->bindParam(":idInsc", $idInsc);
$ShowEventInscriptionStatement->bindParam(":idEvent", $idEvent);

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

$updateInscriptionStatement = $db->prepare("update Inscription set idEvent=:idEvent,genre=:genre,nom=:nom,prenom=:prenom,niveauExp=:niveauExp,email=:email,tel=:tel,adressePost=:adressePost,dept=:dept,pays=:pays,repas=:repas where idInsc=:idInsc");
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

class InscriptionDAO
{
    public function ShowAllInscriptions()
    {
        $InscTable = null;
        global $ShowAllInscriptionStatement;
        if ($ShowAllInscriptionStatement->execute()) {
            while ($obj = $ShowAllInscriptionStatement->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas);
                $InscTable[] = $InscObj;
            }
            return $InscTable;
        }
    }

    public function ShowInscription($id)
    {
        global $ShowInscriptionStatement;
        global $idInsc;
        $idInsc = $id;
        if ($ShowInscriptionStatement->execute()) {
            while ($obj = $ShowInscriptionStatement->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas);
            }
            return $InscObj;
        }
    }

    public function ShowEventInscription($id,$idE)
    {
        global $ShowEventInscriptionStatement;
        global $idInsc;
        global $idEvent;
        $idInsc = $id;
        $idEvent=$idE;
        if ($ShowEventInscriptionStatement->execute()) {
            while ($obj = $ShowEventInscriptionStatement->fetchObject()) {
                $InscObj = new Inscription($obj->idEvent, $obj->idInsc, $obj->genre, $obj->nom, $obj->prenom, $obj->niveauExp, $obj->email, $obj->tel, $obj->adressePost, $obj->dept, $obj->pays, $obj->repas);
            }
            return $InscObj;
        }
    }

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
        if(!is_null($event)){
            if(date("Y-m-d H:i:s")<$event->datedebutEvent) {
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

    public function updateInscription($id,$obj)
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

        if ($updateInscriptionStatement->execute()) {
            return 1;
        } else {
            return 0;
        }

    }
}

/*$ev = new InscriptionDAO();
echo "reussi";
print_r($ev->ShowAllInscriptions());
echo "shiit\n";
echo $ev->updateInscription(1,new Inscription(3, 3, 3, 3, 3, 3, 3,3,3,3,3,"@01000@"));
echo "shiit\n";
print_r($ev->ShowInscription(1));*/


