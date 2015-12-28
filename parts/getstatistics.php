<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 27/12/2015
 * Time: 00:43
 */
include "adminCheck.php";
include "../Imports.php";
if($_GET["evid"]) {
    $idEv = $_GET["evid"];
    $ps = $InscDAO->ShowEventInscription($idEv);
    $v1=0;
    $v2=0;
    $v3=0;

    foreach((array)$ps as $p){
        if($p->niveauExp=='Débutant')
            $v1++;
        elseif($p->niveauExp=='Confirmé')
            $v2++;
        elseif($p->niveauExp=='Expert')
            $v3++;
    }
}
    ?>
        <div style="text-align: center;"  id="canvas-holder">
            <canvas id="chart-area" width="300" height="300"/>
        </div>


        <script>

            var data = [
                {
                    value: <?php echo $v3;  ?>,
                    color:"#F7464A",
                    highlight: "#FF5A5E",
                    label: "Expert"
                },
                {
                    value: <?php echo $v1;  ?>,
                    color: "#46BFBD",
                    highlight: "#5AD3D1",
                    label: "Débutant"
                },
                {
                    value: <?php echo $v2;  ?>,
                    color: "#FDB45C",
                    highlight: "#FFC870",
                    label: "Confirmé"
                }
            ]

            $(function(){
                var ctx = document.getElementById("chart-area").getContext("2d");
                window.myPie = new Chart(ctx).Pie(data);
            });



        </script>

