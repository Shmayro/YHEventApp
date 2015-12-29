<?php
    /**
     * Formulaire utilisé pour l'ajout des inscription a des events
     */
?>
<div class="modal fade" id="inscForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="FormInsc" method="post" action="parts/InscriptionAdd.php">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label" for="genre" required="required">Genre</label>
                        </div>
                        <div class="col-sm-10">
                            <select id="genre" name="genre" class="form-control">
                                <option>Madame</option>
                                <option>Monsieur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="nom" class="control-label">Nom</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"
                                   required="required">
                        </div>
                        <div class="col-sm-2">
                            <label for="prenom" class="control-label">Prenom</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="prenom" placeholder="Prenom" name="prenom"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="control-label" for="expLvl">Niveau d’expertise</label>
                        </div>
                        <div class="col-sm-8">
                            <select id="expLvl" class="form-control" name="expLvl" required="required">
                                <option>Débutant</option>
                                <option>Confirmé</option>
                                <option>Expert</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label" for="email">Email</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label" for="tel">Téléphone</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tel" name="tel" placeholder="Téléphone">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="adressePost" class="control-label">Adresse postal</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="adressePost" name="adressePost"
                                      placeholder="Adresse postal"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label" for="dept">Département</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="dept" placeholder="Départemnt" name="dept"
                                   required="required">
                        </div>
                        <div class="col-sm-2">
                            <label for="pays" class="control-label">Pays</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="pays" placeholder="Pays" name="pays"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label">Repas</label>
                        </div>
                        <div id="repas" style="max-height: 100px;overflow-y: auto;" class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">Check me out</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="submit" hidden="hidden" name="idevent" id="submitbtnInsc" value="900">
                    </div>
                </form>
                <script>
                    $(function () {
                        //evenement lors du click de ajout d'events
                        $("#btnInsc").click(function () {
                            $("#submitbtnInsc").click();

                        });
                        //fermeture du formulaire
                        $("#closebtn").click(function () {
                            //alert("Fermeture");
                            $("#confirmsg").remove();
                            $("#FormInsc")[0].reset();
                            $("#FormInsc,#btnInsc").show();
                        });
                        //validation du formulaire
                        $("#FormInsc").submit(function (e) {
                            e.preventDefault();
                            var $this = $(this); // L'objet jQuery du formulaire

                            $.ajax({
                                url: $this.attr('action'),
                                type: $this.attr('method'),
                                data: $this.serialize()+"&totaldays="+$("#repas").find('input:checkbox').length+"&idEv="+$("#submitbtnInsc").attr("value"),
                                success: function (html) {
                                    $("#inscForm").find(".modal-body").append(html);
                                    $("#FormInsc,#btnInsc").hide();
                                }
                            });

                        });
                        //evenement lors du click de la du boutton inscription
                        $(document).on('click', '.inscEventbtn', function(){
                            //alert("work");
                            moment.locale('fr');
                            var datedebut = moment($(this).parent().find(".dates > .DateDebut > .date")[0].innerHTML);
                            var datefin = moment($(this).parent().find(".dates > .DateFin > .date")[0].innerHTML);
                            var days = datefin.diff(datedebut, 'days');//Math.round((datefin-datedebut)/(1000*60*60*24));
                            //alert(days);
                            $("#repas").empty();
                            $("#submitbtnInsc").attr("value", $(this).attr("id"));
                            //alert($("#submitbtnInsc").attr("value"),$(this).attr("id"));
                            var repasdate = datedebut;

                            //genère une case a coché pour chaque journnée de l'event
                            $("#repas").append("<div class='checkbox'><label><input name='day" + 0 + "' type='checkbox'>Le " + repasdate.format("dddd, Do MMMM YYYY") + "</label></div>");
                            for (var i = 1; i <= days; i++) {
                                $("#repas").append("<div class='checkbox'><label><input name='day" + i + "' type='checkbox'>Le " + repasdate.add(1, "days").format("dddd, Do MMMM YYYY") + "</label></div>");
                            }
                            //alert(datedebut.diff(datefin, 'days') +" "+datedebut.format("dddd,Do MMMM YYYY, h:mm:ss a")+" "+datefin);
                        });
                    });
                </script>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal" id="closebtn">Fermer</a>
                <a class="btn btn-primary" id="btnInsc">S'inscrire</a>
            </div>
        </div>
    </div>
</div>