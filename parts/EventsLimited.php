<?php
/**
 * Block de pagination des Evenenent par 6 Events dans chaque page
 *
 * permet de recupèrer les events en utilisant getEvents.php .
 *
 */
?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Events</h1>
            </div>
        </div>
        <ul id="Events" style="padding: 0px" class="row grid cs-style-3">

        </ul>
        <div class="row">
            <script>
                    //nombre de pages Au total
                    var totalPages;
                    //recupèrer le nombre de page en utilisant getnumEventspages.php
                    $.ajax({
                        url: 'parts/getnumEventspages.php',
                        success:function (html) {
                            totalPages=html;
                            totalPages++;
                            totalPages--;
                            $("#totalpages").html(" /"+html);
                        }
                    });
                    //Afficher les Evenement selon le numero de page pour la première foie
                    $.ajax({
                        method:"POST",
                        url:'parts/getEvents.php',
                        data:{numPage:$("#pageindex").val()},
                        success:function(events){
                            $("#Events").empty();
                            $("#Events").append(events);
                        }
                    });
                    $(function(){
                        //Chargement complet de la page

                        //click du button suivant
                        $("#prev").click(function(e){
                            e.preventDefault();
                            var num=$("#pageindex").val();
                            if(num>1)
                                num--;
                            $("#pageindex").val(num).change();
                        });
                        //click du boutton suivant
                        $("#suiv").click(function(e){
                            e.preventDefault();
                            var num=$("#pageindex").val();
                            if(num<totalPages)
                                num++;
                            $("#pageindex").val(num).change();
                        });
                        /**
                         * Evenement declancher apres chaque changement de la page
                         * permet de recupèrer les données apartir de la page getEvents
                         */
                        $("#pageindex").on("change input",function(){
                            var num=$("#pageindex").val();
                            //verification du num introduit
                            if(num<=totalPages && num>=1){
                                //numpage respectant les limites
                                $.ajax({
                                    method:"POST",
                                    url:'parts/getEvents.php',
                                    data:{numPage:$("#pageindex").val()},
                                    success:function(events){
                                        $("#Events").empty();
                                        $("#Events").append(events);
                                    }
                                });
                            }
                            else{
                                //numpage hors la limites
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