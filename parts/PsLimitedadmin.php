<?php
/**
 * Verifie si la session admin est valide
 * permet d'afficher une pagination des participants d'un evenement avec l'id $_POST["EvId"]
 * et des bouttons pour afficher les repas ou les statistiques ou la generation de tout les pdf pour tout les participants
 */
include "adminCheck.php";
include_once "../Imports.php";
$EvId=1;
if (isset($_POST["EvId"]))
    $EvId=$_POST["EvId"];
$evname=$evDAO->ShowEvent($EvId)->titleEvent;
?>
<div class="section">
    <div class="container" style="width:auto;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Participents - <?php echo $evname;?></h1>
            </div>
            <a class="btn btn-sm btn-primary" target="_blank" href="parts/Generatexcel.php?EvId=<?php echo $EvId;?>"><i class=" glyphicon glyphicon-file"></i>Télécharger la liste de participants</a>  <a class="btn btn-sm btn-success genpdf" target="_blank" href="parts/Generatepdf.php?evid=<?php echo $EvId;?>"><i class=" glyphicon glyphicon-retweet"></i>Générer Toutes les Attestations</a>  <a id="repas" class="btn btn-sm btn-warning getextrainfos" href="parts/getrepas.php?evid=<?php echo $EvId;?>"  data-toggle="modal" data-target="#modalC"><i class="glyphicon glyphicon-apple"></i>Repas</a>  <a id="statics" class="btn btn-sm btn-info getextrainfos" href="parts/getstatistics.php?evid=<?php echo $EvId;?>" data-toggle="modal" data-target="#modalC"><i class=" glyphicon glyphicon-stats"></i>Statistiques</a>
        </div>
        <div class="row">
            <table id="myTable" class="tablesorter table table-bordered">
                <thead>
                <tr>
                    <th>Nom & Prenom</th>
                    <th>Niveau</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Departement</th>
                    <th>Pays</th>
                    <th>Attest</th>
                </tr>
                </thead>
                <tbody id="partcipentsTable">

                </tbody>
            </table>
        </div>
        <div class="row">
            <script>
                var totalPages;
                //retourne le nombre total des pages
                $.ajax({
                    url: 'parts/getnumPspages.php?EvId=<?php echo $EvId;?>',
                    success:function (html) {
                        totalPages=html;
                        totalPages++;
                        totalPages--;
                        $("#totalpages").html(" /"+html);
                    }
                });
                //affiche la liste des participants selon le page index
                $.ajax({
                    method:"POST",
                    url:'parts/getPsadmin.php',
                    data:{numPage:$("#pageindex").val(),EvId:<?php echo $EvId;?>},
                    success:function(PS){
                        //alert(PS);
                        $("#partcipentsTable").empty();
                        $("#partcipentsTable").append(PS);
                    }
                });

                $(function(){
                    //chargement complet de la page
                    //evenement lors du clique sur page suivante
                    $("#prev").click(function(e){
                        e.preventDefault();
                        var num=$("#pageindex").val();
                        if(num>1)
                            num--;
                        $("#pageindex").val(num).change();
                    });
                    //evenement du clique sur boutton suivant
                    $("#suiv").click(function(e){
                        e.preventDefault();
                        var num=$("#pageindex").val();
                        if(num<totalPages)
                            num++;
                        $("#pageindex").val(num).change();
                    });
                    //avoir la liste des participants d'une page lors de la modification de la pageindex
                    $("#pageindex").on("change input",function(){
                        var num=$("#pageindex").val();
                        //verification de la pageindex
                        if(num<=totalPages && num>=1){
                            //dans la limite
                            $.ajax({
                                method:"POST",
                                url:'parts/getPsadmin.php',
                                data:{numPage:$("#pageindex").val(),EvId:<?php echo $EvId;?>},
                                success:function(PS){
                                    $("#partcipentsTable").empty();
                                    $("#partcipentsTable").append(PS);
                                }
                            });
                        }
                        else{
                            //hors limite
                            $("#pageindex").val(1).change();
                        }
                    });
                });
            </script>
            <div class="col-md-12">
                <ul class="pager">
                    <li>
                        <a id="prev" href=""><i class="fa fa-fw text-inverse fa-angle-left"></i> Prev</a>
                    </li>
                    <input style="width: 40px" type="text" value="1" name="pageindex" id="pageindex"/><div style="display: inline" id="totalpages"></div>
                    <li>
                        <a id="suiv" href="" >Next <i class="fa fa-fw text-inverse fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>