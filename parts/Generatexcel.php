<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 26/12/2015
 * Time: 21:34
 */
include "adminCheck.php";
require "../Imports.php";
if (isset($_GET["EvId"])) {
    $EvId = Securite::bdd($_GET["EvId"]);
    $inscev=$InscDAO->ShowEventInscription($EvId);
    $evobj=$evDAO->ShowEvent($EvId);
    header("Content-Disposition: attachment; filename=\"Participants_$EvId.xls\"");
    header("Content-Type: application/vnd.ms-excel;");
    header("Pragma: no-cache");
    header("Expires: 0");
    ?>
<html lang="fr">
<head>
    <title>Participents</title>
    <meta charset="utf-8">
</head>
<body>
<h3>Liste des Participants de l'event <?php echo "[$evobj->idEvent]$evobj->titleEvent";?></h3>
<table border="1" id="myTable" class="tablesorter table table-bordered">
    <thead>
    <tr>
        <th>Nom & Prenom</th>
        <th>Niveau</th>
        <th>Email</th>
        <th>Telephone</th>
        <th>Adresse Postal</th>
        <th>Departement</th>
        <th>Pays</th>
    </tr>
    </thead>
    <tbody id="partcipentsTable">
    <?php
    //$out = fopen("php://output", 'w');
    foreach ((array)$inscev as $Pobj) {
        $np=(($Pobj->genre=="Monsieur")?"M. ":"Mme ").$Pobj->nom." ".$Pobj->prenom;
        ?>
        <tr>
            <td><?php echo $np; ?></td>
            <td><?php echo $Pobj->niveauExp; ?></td>
            <td><?php echo $Pobj->email; ?></td>
            <td><?php echo $Pobj->tel; ?></td>
            <td><?php echo $Pobj->adressePost; ?></td>
            <td><?php echo $Pobj->dept; ?></td>
            <td><?php echo $Pobj->pays; ?></td>
        </tr>
    <?php }
    //fclose($out);
}
?>
</tbody>
    </table>
</body>