<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 25/12/2015
 * Time: 09:13
 */
include "adminCheck.php";
include "../Imports.php";
$numPage = 1;
$nbrparpage=6;
if (isset($_POST["numPage"])) {
    $numPage = Securite::bdd($_POST["numPage"]);
}
$eventsobj = $evDAO->ShowAllEventsLimited(($numPage - 1)*$nbrparpage, $nbrparpage);
foreach ((array)$eventsobj as $eventobj) {
    ?>
    <li class="col-md-4">
        <figure>
            <div>
                <h3 class="soloTitle"><?php echo Securite::html($eventobj->titleEvent); ?></h3>
                <img src="<?php echo stripslashes(stripslashes(Securite::html($eventobj->lieuEventPic))); ?>"
                     alt="<?php echo Securite::html($eventobj->titleEvent); ?>"/>
                <div class="Location">
                    <i class="glyphicon glyphicon-map-marker"></i><?php echo Securite::html($eventobj->lieuEvent); ?>
                </div>
                <div></div>
            </div>
            <figcaption>
                <div class="logo"><?php echo Securite::html($eventobj->logoEvent); ?></div>
                <a class="btn btn-sm btn-danger DeletetEventbtn" style="left: 20px;right: inherit;"
                   id="<?php echo Securite::html($eventobj->idEvent); ?>"
                   data-toggle="modal" data-target="#DelForm">Delete</a>
                <a class="btn btn-sm btn-warning EditEventbtn" style="left: 80px;right: inherit;"
                   id="<?php echo Securite::html($eventobj->idEvent); ?>"
                   data-toggle="modal" href="#" data-target="#EvForm">Edit</a>
                <a class="btn btn-sm btn-success SelectEventbtn"
                   id="<?php echo Securite::html($eventobj->idEvent); ?>"
                >Select</a>

            </figcaption>
        </figure>
    </li>
<?php } ?>