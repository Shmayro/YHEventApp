<?php
/**
 * Verifier si la session admin est toujours Valide
 * pour but d'autoriser ou interdir l'execution des parties special a l'administration
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

