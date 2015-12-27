<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 25/12/2015
 * Time: 18:32
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

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/blueSortableTable/style.css">
    <script type="text/javascript" src="js/modernizr.custom.js"></script>

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
                    Start Bootstrap
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
    var evid=null;
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $.ajax({
        url: "parts/EventsLimitedadmin.php",
        type: "post",
        success: function (html) {
            $("#page_content").empty();
            $("#page_content").append(html);
        }
    });
    $(function(){

        $("#deco").click(function(){
            $.ajax({
                url: "parts/deco.php",
                type: "post",
                success: function (html) {
                    location.reload();
                }
            });
        });
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
<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body...</p>
            </div>
        </div>
    </div>
</div>
<?php include "parts/EventFormModal.php" ?>
</html>

