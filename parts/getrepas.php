<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 27/12/2015
 * Time: 00:43
 */
include "adminCheck.php";
include "../Imports.php";
if($_GET["evid"]){
$idEv = $_GET["evid"];
$ps = $InscDAO->ShowEventInscription($idEv);
$event = $evDAO->ShowEvent($idEv);
$partls = null;
if($event!=null) {
    $debutEv = date_create(Securite::html($event->datedebutEvent));
    $finEv = date_create(Securite::html($event->datefinEvent));

    $nbrdays = date_diff($debutEv, $finEv)->days;

    $currday = $debutEv;

    $i = 0;
    while ($i <= $nbrdays) {
        $part = null;
        if ($i != 0)
            $debutEv->modify('+1 day');
        $date = $debutEv->format('d/m/Y');
        foreach ((array)$ps as $p) {
            $d = $p->repas . '';
            if ($d[$i] == 1) {
                $np = (($p->genre == "Monsieur") ? "M. " : "Mme ") . $p->nom . " " . $p->prenom;
                //echo $np;
                $part[] = $np;
            }
        }
        $i++;
        $dayobj = null;
        $dayobj[] = $date;
        $dayobj[] = $part;
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
        foreach((array)$partls as $dayEv){

            echo"<tr><th rowspan='".count($dayEv[1])."'>".$dayEv[0]."<br/>".count($dayEv[1])." Repas"."</th><td>".$dayEv[1][0]."</td></tr>";
            $flag=1;
            foreach((array)$dayEv[1] as $item){
                if($flag==1){
                    $flag=0;
                }else{
                    echo "<tr><td>$item</td></tr>";
                }
            }
        }
    ?>
    </tbody>
</table>
<?php } ?>