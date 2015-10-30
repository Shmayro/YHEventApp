<?php
/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 26/10/15
 * Time: 11:23
 */
$hostname = "localhost";
$dbname = "YHEventApp";
$username = "root";
$password = "";
try {
    $db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    echo("db connecté !!<br>");
} catch (Exception $ex) {
    echo("db Error !!");
    die();
}
?>

