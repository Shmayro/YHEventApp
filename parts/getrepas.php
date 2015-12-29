<?php
/**
 * Apres la verfication de la session Admin
 * retourne un tableau Html contenant le nombre des repas pour chaque journnée de l'evenement avec l'id $_GET["evid"], ainsi que les participants concernés
 */
include "adminCheck.php";
include "../Imports.php";
if ($_GET["evid"]) {

    //id de l'event
    $idEv = $_GET["evid"];

    //list des participant de l'event
    $ps = $InscDAO->ShowEventInscription($idEv);

    //objet event
    $event = $evDAO->ShowEvent($idEv);

    //list des paticipants ayant un repat par journnée
    $partls = null;

    if ($event != null) {
        $debutEv = date_create(Securite::html($event->datedebutEvent));
        $finEv = date_create(Securite::html($event->datefinEvent));

        //calcul du nombre de jour d'un event
        $nbrdays = date_diff($debutEv, $finEv)->days;

        //juste pointeur pour Afficher chaque journée par une boucle
        $currday = $debutEv;

        //poiteur des jours
        $i = 0;

        while ($i <= $nbrdays) {
            //pour chaque journée de l'event

            //liste des participants qui ont des repas dans la journée $i
            $part = null;
            if ($i != 0)
                $debutEv->modify('+1 day');

            //la date d'un jour de l'event
            $date = $debutEv->format('d/m/Y');

            foreach ((array)$ps as $p) {
                //pour chaque participant de l'evenement, on prend le champs repas
                $d = $p->repas . '';
                //on verfie la valeur du caractaire de la journnée $i pou voir si ila un repas ou nn
                if ($d[$i] == 1) {
                    //genre nom prenom du participant
                    $np = (($p->genre == "Monsieur") ? "M. " : "Mme ") . $p->nom . " " . $p->prenom;
                    //echo $np;
                    //ajouter le participant a la liste
                    $part[] = $np;
                }
            }
            $i++;
            //table qui resoit la date et la liste des participants
            $dayobj = null;
            $dayobj[] = $date;
            $dayobj[] = $part;

            //ajouter la table du jour a la table global
            $partls[] = $dayobj;
        }
    }
//print_r($partls);
    ?>
    <table border="1" id="myTableRepas" class="tablesorter table table-bordered">
        <thead>
        <tr>
            <th>Jour</th>
            <th>Nom & Prenom</th>
        </tr>
        </thead>
        <tbody id="partcipentsTable">
        <?php
        foreach ((array)$partls as $dayEv) {
            //boucle pour chaque jours
            echo "<tr><th rowspan='" . count($dayEv[1]) . "'>" . $dayEv[0] . "<br/>" . count($dayEv[1]) . " Repas" . "</th><td>" . $dayEv[1][0] . "</td></tr>";
            $flag = 1;
            foreach ((array)$dayEv[1] as $item) {
                //pour chaque participants
                if ($flag == 1) {
                    $flag = 0;
                } else {
                    echo "<tr><td>$item</td></tr>";
                }
            }
        }
        ?>
        </tbody>
    </table>
<?php } ?>