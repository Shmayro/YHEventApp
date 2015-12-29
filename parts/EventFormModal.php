<div class="modal fade" id="EvForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Evènement</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="FormEv" method="post" action="parts/EventAdd.php">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="titleEvent" class="control-label">Titre Event</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="titleEvent" placeholder="Titre Event" name="titleEvent"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="logoEvent" class="control-label">Logo Event</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" id="logoEvent" placeholder="Logo Event" name="logoEvent"
                                   required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="lieuEvent" class="control-label">Lieu Event</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lieuEvent" placeholder="Lieu Event" name="lieuEvent"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="imgEvent" class="control-label">Url Event</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="url" class="form-control" id="imgEvent" placeholder="URL Image" name="imgEvent"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="datedebutInsc" class="control-label">Inscription du</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime" class="form-control" id="datedebutInsc" name="datedebutInsc"
                                   required="required">
                        </div>
                        <div class="col-sm-1">
                            <label for="datefinInsc" class="control-label">au</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime" class="form-control" id="datefinInsc" name="datefinInsc"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="datedebutEvent" class="control-label">Evenement du</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime" class="form-control" id="datedebutEvent" name="datedebutEvent"
                                   required="required">
                        </div>
                        <div class="col-sm-1">
                            <label for="datefinEvent" class="control-label">au</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime" class="form-control" id="datefinEvent" name="datefinEvent"
                                   required="required">
                        </div>
                    </div>
                        <input type="submit" hidden="hidden" id="submitbtnEvent">
                    </div>
                </form>
                <script>
                    $(function () {
                        $("#btnEvent").click(function () {
                            $("#submitbtnEvent").click();

                        });
                        $("#closebtn").click(function () {
                            //alert("Fermeture");
                            $("#confirmsg").remove();
                            $("#FormEv")[0].reset();
                            $("#FormEv,#btnEvent").show();
                            $("#events").click();

                            $("#submitbtnEvent").removeAttr("value");

                            $("#btnEvent").text("Ajouter");
                        });
                        $("#FormEv").submit(function (e) {
                            e.preventDefault();
                            var $this = $(this); // L'objet jQuery du formulaire
                            //&idEv="+$("#submitbtnInsc").attr("value")$("#submitbtnEvent")
                            var urlextraData="";
                            if($("#submitbtnEvent").val()!=null)
                                urlextraData="&idEv="+$("#submitbtnEvent").val();
                            $.ajax({
                                url: $this.attr('action'),
                                type: $this.attr('method'),
                                data: $this.serialize()+urlextraData,
                                success: function (html) {
                                    $("#EvForm").find(".modal-body").append(html);
                                    $("#FormEv,#btnEvent").hide();
                                }
                            });

                        });
                    });
                </script>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal" id="closebtn">Fermer</a>
                <a class="btn btn-primary" id="btnEvent">Ajouter</a>
            </div>
        </div>
    </div>
</div>