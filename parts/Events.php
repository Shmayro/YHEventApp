<?php
/**
 * Affiche tout les evenement [Pas utilisé dans le projet]
 */
$eventsobj=$evDAO->ShowAllEvents();
?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Events</h1>
                <p class="text-center lead">A subtitle.</p>
            </div>
        </div>
        <ul id="Events" class="row grid cs-style-3">
            <?php
                foreach((array)$eventsobj as $eventobj){
            ?>
            <li class="col-md-4">
                <figure>
                    <div>
                        <h3 class="soloTitle"><?php echo Securite::html($eventobj->titleEvent); ?></h3>
                        <img
                            src="<?php echo Securite::html($eventobj->lieuEventPic); ?>"
                            alt="<?php echo Securite::html($eventobj->titleEvent); ?>">
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
                                <span class="date"><?php echo date_format(date_create(Securite::html($eventobj->datedebutEvent)),"F d, o"); ?></span>
                                <i class="glyphicon glyphicon-time"></i>
                                <span class="time"><?php echo date_format(date_create(Securite::html($eventobj->datedebutEvent)),"H:i"); ?></span>
                            </div>
                            <div class="DateFin">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <span class="date"><?php echo date_format(date_create(Securite::html($eventobj->datefinEvent)),"F d, o"); ?></span>
                                <i class="glyphicon glyphicon-time"></i>
                                <span class="time"><span class="time"><?php echo date_format(date_create(Securite::html($eventobj->datefinEvent)),"H:i"); ?></span></span>
                            </div>
                        </div>
                        <a class="btn btn-sm btn-success inscEventbtn" id="<?php echo Securite::html($eventobj->idEvent); ?>" data-toggle="modal" data-target="#inscForm">S'inscrire</a>
                    </figcaption>
                </figure>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
