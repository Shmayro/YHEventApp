<div class="modal fade" id="inscForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="FormInsc" method="post" action="bimo.php">
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
                        $("#btnInsc").click(function () {
                            $("#submitbtnInsc").click();

                        });
                        $("#closebtn").click(function () {
                            //alert("Fermeture");
                            $("#confirmsg").remove();
                            $("#FormInsc")[0].reset();
                            $("#FormInsc,#btnInsc").show();
                        });
                        $("#FormInsc").submit(function (e) {
                            e.preventDefault();
                            var $this = $(this); // L'objet jQuery du formulaire
                            $.ajax({
                                url: $this.attr('index.html'),
                                type: $this.attr('post'),
                                data: $this.serialize(),
                                success: function (html) {
                                    //alert("sumition");
                                    $("#FormInsc,#btnInsc").hide();
                                }
                            });

                        });
                        $(".inscEventbtn").click(function () {
                            moment.locale('fr');
                            var datedebut = moment($(this).parent().find(".dates > .DateDebut > .date")[0].innerHTML);
                            var datefin = moment($(this).parent().find(".dates > .DateFin > .date")[0].innerHTML);
                            var days = datefin.diff(datedebut, 'days');//Math.round((datefin-datedebut)/(1000*60*60*24));
                            $("#repas").empty();
                            $("#submitbtnInsc").attr("value", $(this).attr("id"));
                            //alert($("#submitbtnInsc").attr("value"),$(this).attr("id"));
                            var repasdate = datedebut;
                            $("#repas").append("<div class='checkbox'><label><input name='day" + i + "' type='checkbox'>Le " + repasdate.format("dddd, Do MMMM YYYY") + "</label></div>");
                            for (var i = 0; i < days; i++) {
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