<?php
/**
 * Page d'acceuil de la partie administration du site
 */
include "parts/adminCheck.php";
?>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Pannel YHEventApp</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/blueSortableTable/style.css">
    <script type="text/javascript" src="js/modernizr.custom.js"></script>
    <script type="text/javascript" src="js/Chart.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    YHEventApp
                </a>
            </li>
            <li>
                <a data-toggle="modal" href="#" data-target="#EvForm">Ajouter Evenement</>
            </li>
            <li>
                <a id="events" href="#">Events</a>
            </li>
            <li>
                <a id="deco" href="#">Deconnexion</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div id="page_content" class="container-fluid">

        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    //id de event selectionné
    var evid=null;
    //code de la side bar
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    //recupère les events avec pagination
    $.ajax({
        url: "parts/EventsLimitedadmin.php",
        type: "post",
        success: function (html) {
            $("#page_content").empty();
            $("#page_content").append(html);
        }
    });

    $(function(){
        //chargement complet de la page
        //click deconnection
        $("#deco").click(function(){
            $.ajax({
                url: "parts/deco.php",
                type: "post",
                success: function (html) {
                    location.reload();
                }
            });
        });
        //click Events au menu
        $("#events").click(function(){
            $.ajax({
                url: "parts/EventsLimitedadmin.php",
                type: "post",
                success: function (html) {
                    $("#page_content").empty();
                    $("#page_content").append(html);
                }
            });
        });
        //selectionnner un evennement event
        $(document).on('click', '.SelectEventbtn', function(){
            evid=$(this).attr("id");
            $.ajax({
                url: "parts/PsLimitedadmin.php",
                type: "post",
                data:{EvId:$(this).attr("id")},
                success: function (html) {
                    $("#page_content").empty();
                    $("#page_content").append(html);
                }
            });
        });
        //click sur edition event pour un event
        $(document).on('click', '.EditEventbtn', function(){
            evid=$(this).attr("id");
            //remplir les informations actuels de l'event sur le formulaire
            $.ajax({
                url: "parts/getjsonEvent.php",
                type: "post",
                data: {EvId: $(this).attr("id")},
                success: function (ev) {
                    $("#titleEvent").val(ev.titleEvent);
                    $("#logoEvent").val(ev.logoEvent);
                    $("#lieuEvent").val(ev.lieuEvent);
                    $("#imgEvent").val(ev.lieuEventPic);
                    $("#datedebutInsc").val(ev.datedebutInsc);
                    $("#datefinInsc").val(ev.datefinInsc);
                    $("#datedebutEvent").val(ev.datedebutEvent);
                    $("#datefinEvent").val(ev.datefinEvent);
                    $("#submitbtnEvent").val(evid);
                    $("#btnEvent").text("Modifier");
                }
            });

        });
        //click delete pour un event
        $(document).on('click', '.DeletetEventbtn', function(){
            evid=$(this).attr("id");
            if(confirm("Voulez Vous Vraiment Supprimer Cet Evenement?")) {
                $.ajax({
                    url: "parts/delEvent.php",
                    type: "post",
                    data: {EvId: $(this).attr("id")},
                    success: function () {
                        $("#events").click();
                    }
                });
            }
        });
        //clique pour avoir l'invitation en pdf d'un participant
        $(document).on('click', '.genpdf', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr("href"),
                type: "get",
                success: function () {
                    $("#pageindex").change();
                }
            });
        });
    });
</script>
</body>
<script type="text/javascript">
    $(function(){
        //special pour afficher les statistiques et les repas d'un evenement dans le modal #modalCbody
        $(document).on('click', '.getextrainfos', function(e){
            e.preventDefault();
            $("#modalCbody").empty();
            var title=$(this).html();
            $.ajax({
                url: $(this).attr("href"),
                type: "get",
                success: function (html) {
                    $("#modalCbody").empty();

                    $("#modalCbody").append("<h1 class='text-center'>"+title+"</h1>");
                    $("#modalCbody").append(html);
                }
            });
        });
    });
</script>
<div class="modal fade" id="modalC">
    <div class="modal-dialog">
        <div id="modalCbody" class="modal-content">

        </div>
    </div>
</div>
<?php include "parts/EventFormModal.php" ?>
</html>

