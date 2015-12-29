<?php
/**
 * Apres la verfication de la session Admin
 * retourne un Tableau en HTML triable comportant la page des Participants demandée
 * par defaut en affiche la première page
 */
include "adminCheck.php";
include "../Imports.php";
$numPage = 1;
$numparPage=20;
if (isset($_POST["numPage"])) {
    $numPage = Securite::bdd($_POST["numPage"]);
}
if (isset($_POST["EvId"])){
    $IdEv = Securite::bdd($_POST["EvId"]);
    $Psobj = $InscDAO->ShowEventPSLimited($IdEv,($numPage - 1)*$numparPage, $numparPage);

    foreach ((array)$Psobj as $Pobj) {
        $np=(($Pobj->genre=="Monsieur")?"M. ":"Mme ").$Pobj->nom." ".$Pobj->prenom;
    ?>
    <tr>
        <td><?php echo Securite::html($np); ?></td>
        <td><?php echo Securite::html($Pobj->niveauExp); ?></td>
        <td><?php echo Securite::html($Pobj->email); ?></td>
        <td><?php echo Securite::html($Pobj->tel); ?></td>
        <td><?php echo Securite::html($Pobj->dept); ?></td>
        <td><?php echo Securite::html($Pobj->pays); ?></td>
        <td><a href=""><?php if($Pobj->pdf==1)
                                    echo "<a class='btn btn-sm btn-success' target='_blank' href='parts/Getpdf.php?p=".$Pobj->idInsc."'><i class='glyphicon glyphicon-file'></i>Pdf</a>";
                                else
                                    echo "<a class='btn btn-sm btn-warning genpdf' target='_blank' href='parts/Generatepdf.php?p=".$Pobj->idInsc."'><i class='glyphicon glyphicon-retweet'></i>Générer Attestation</a>";
            ?></td>
    </tr>
<?php }} ?>
    <script type="text/javascript">
        $(function(){
            //activer la triabilité de la table
            $("#myTable").tablesorter();
            $("#myTable").trigger('update');
        });
    </script>
