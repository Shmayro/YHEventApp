<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 25/12/2015
 * Time: 17:26
 */
session_start();
if(isset($_SESSION["admn"])&&isset($_SESSION["start"])&&isset($_SESSION["expire"])){
    $now=time();
    if($now<=$_SESSION["expire"] && $now>=$_SESSION["start"]){
        $_SESSION["expire"]=$now+(5 * 60);
    }else{
        session_destroy();
        header("location://".$_SERVER['HTTP_HOST']."/YHEventApp/");
    }
}else{
    session_destroy();
    header("location://".$_SERVER['HTTP_HOST']."/YHEventApp/");
    die();
}
;
?>

