<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 24/12/2015
 * Time: 22:01
 */
include_once "../Imports.php";
echo ceil(count($evDAO->ShowAllEvents())/6);