<?php
/**
 * permet de retourner le nombre de pages total pour les Evenements
 * 6 Events par page
 */
include_once "../Imports.php";
echo ceil(count($evDAO->ShowAllEvents())/6);