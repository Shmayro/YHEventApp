<?php
/**
 * Sert a etablir une connexion a la base de données
 */
$hostname = "uf63wl4z2daq9dbb.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$dbname = "jjsoiprm30psalxm";
$username = "njylx72mppl2kgcu";
$password = "k8yc8wiqxemq4gni";
try {
    $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    //echo("db connecté !!<br>");
} catch (Exception $ex) {
    echo("db Error !!");
    die();
}
?>

