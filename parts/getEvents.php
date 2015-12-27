<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 25/12/2015
 * Time: 09:13
 */
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
                <div class="dates">
                    <div class="DateDebut">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <span
                            class="date"><?php echo date_format(date_create(Securite::html($eventobj->datedebutEvent)), "F d, o"); ?></span>
                        <i class="glyphicon glyphicon-time"></i>
                        <span
                            class="time"><?php echo date_format(date_create(Securite::html($eventobj->datedebutEvent)), "H:i"); ?></span>
                    </div>
                    <div class="DateFin">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <span
                            class="date"><?php echo date_format(date_create(Securite::html($eventobj->datefinEvent)), "F d, o"); ?></span>
                        <i class="glyphicon glyphicon-time"></i>
                        <span class="time"><span
                                class="time"><?php echo date_format(date_create(Securite::html($eventobj->datefinEvent)), "H:i"); ?></span></span>
                    </div>
                </div>
                <?php
                $today = date("Y-m-d H:i:s");
                $debutInsc= date_format(date_create(Securite::html($eventobj->datedebutInsc)), "Y-m-d H:i:s");
                $finInsc= date_format(date_create(Securite::html($eventobj->datefinInsc)), "Y-m-d H:i:s");

                if ($debutInsc <= $today && $finInsc >= $today) {
                    ?>
                    <a class="btn btn-sm btn-success inscEventbtn"
                       id="<?php echo Securite::html($eventobj->idEvent); ?>"
                       data-toggle="modal" data-target="#inscForm">S'inscrire</a>
                    <?php
                }else if($debutInsc > $today){

                    ?>
                    <a class="btn btn-sm btn-info inscEventbtn">Debut le<?php echo date_format(date_create(Securite::html($eventobj->datedebutEvent)), "d/m"); ?></a>
                    <?php
                }else{
                    ?>
                    <a class="btn btn-sm btn-danger inscEventbtn">Passé</a>
                    <?php
                }
                ?>

            </figcaption>
        </figure>
    </li>
<?php } ?>