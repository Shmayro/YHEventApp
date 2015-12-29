<?php
/**
 * Sert a etablir une connexion a la base de données
 */
$hostname = "localhost";
$dbname = "YHEventApp";
$username = "root";
$password = "";
try {
    $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    //echo("db connecté !!<br>");
} catch (Exception $ex) {
    echo("db Error !!");
    die();
}
?>

