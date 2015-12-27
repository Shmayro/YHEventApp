<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 24/12/2015
 * Time: 18:47
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
                    var totalPages;
                    $.ajax({
                        url: 'parts/getnumEventspages.php',
                        success:function (html) {
                            totalPages=html;
                            totalPages++;
                            totalPages--;
                            $("#totalpages").html(" /"+html);
                        }
                    });
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
                        $("#prev").click(function(e){
                            e.preventDefault();
                            var num=$("#pageindex").val();
                            if(num>1)
                                num--;
                            $("#pageindex").val(num).change();
                        });
                        $("#suiv").click(function(e){
                            e.preventDefault();
                            var num=$("#pageindex").val();
                            if(num<totalPages)
                                num++;
                            $("#pageindex").val(num).change();
                        });
                        $("#pageindex").on("change input",function(){
                            var num=$("#pageindex").val();
                            if(num<=totalPages && num>=1){
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