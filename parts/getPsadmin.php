<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 26/12/2015
 * Time: 15:36
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
        <td><?php echo $np; ?></td>
        <td><?php echo $Pobj->niveauExp; ?></td>
        <td><?php echo $Pobj->email; ?></td>
        <td><?php echo $Pobj->tel; ?></td>
        <td><?php echo $Pobj->dept; ?></td>
        <td><?php echo $Pobj->pays; ?></td>
        <td><a href=""><?php if($Pobj->pdf==1)
                                    echo "<a class='btn btn-sm btn-success' target='_blank' href='parts/Getpdf.php?p=".$Pobj->idInsc."'><i class='glyphicon glyphicon-file'></i>Pdf</a>";
                                else
                                    echo "<a class='btn btn-sm btn-warning genpdf' target='_blank' href='parts/Generatepdf.php?p=".$Pobj->idInsc."'><i class='glyphicon glyphicon-retweet'></i>Générer Attestation</a>";
            ?></td>
    </tr>
<?php }} ?>
    <script type="text/javascript">
        $(function(){
            $("#myTable").tablesorter();
            $("#myTable").trigger('update');
        });
    </script>
