<?php

require_once("connex.php");
require_once("Event.php");
/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 26/10/15
 * Time: 15:08
 */
$ShowAllEventStatement = $db->prepare("select * from Event");

$ShowAllEventLimitedStatement = $db->prepare("select * from Event limit :fromnumber,:nbrElem");
$ShowAllEventLimitedStatement->bindParam(":fromnumber", $fromnumber);
$ShowAllEventLimitedStatement->bindParam(":nbrElem", $nbrElem);

$ShowEventStatement = $db->prepare("select * from Event WHERE idEvent=:idEvent");
$ShowEventStatement->bindParam(":idEvent", $idEvent);

$deleteEventStatement = $db->prepare("delete from Event WHERE idEvent=:idEvent");
$deleteEventStatement->bindParam(":idEvent", $idEvent);

$addEventStatement = $db->prepare("insert into Event(titleEvent,logoEvent,lieuEvent,lieuEventPic,datedebutEvent,datefinEvent) values (:titleEvent,:logoEvent,:lieuEvent,:lieuEventPic,:datedebutEvent,:datefinEvent)");
$addEventStatement->bindParam(":titleEvent", $titleEvent);
$addEventStatement->bindParam(":logoEvent", $logoEvent);
$addEventStatement->bindParam(":lieuEvent", $lieuEvent);
$addEventStatement->bindParam(":lieuEventPic", $lieuEventPic);
$addEventStatement->bindParam(":datedebutEvent", $datedebutEvent);
$addEventStatement->bindParam(":datefinEvent", $datefinEvent);

$updateEventStatement = $db->prepare("update Event set titleEvent=:titleEvent,logoEvent=:logoEvent,lieuEvent=:lieuEvent,lieuEventPic=:lieuEventPic,datedebutEvent=:datedebutEvent,datefinEvent=:datefinEvent where idEvent=:idEvent");
$updateEventStatement->bindParam(":idEvent", $idEvent);
$updateEventStatement->bindParam(":titleEvent", $titleEvent);
$updateEventStatement->bindParam(":logoEvent", $logoEvent);
$updateEventStatement->bindParam(":lieuEvent", $lieuEvent);
$updateEventStatement->bindParam(":lieuEventPic", $lieuEventPic);
$updateEventStatement->bindParam(":datedebutEvent", $datedebutEvent);
$updateEventStatement->bindParam(":datefinEvent", $datefinEvent);

class EventDAO
{
    public function ShowAllEvents()
    {
        $EventTable = null;
        global $ShowAllEventStatement;
        if ($ShowAllEventStatement->execute()) {
            while ($obj = $ShowAllEventStatement->fetchObject()) {
                $eventObj = new Event($obj->idEvent, $obj->titleEvent, $obj->logoEvent, $obj->lieuEvent, $obj->lieuEventPic, $obj->datedebutEvent, $obj->datefinEvent);
                $EventTable[] = $eventObj;
            }
            return $EventTable;
        }
    }
    public function ShowAllEventsLimited($from,$number)
    {
        $EventTable = null;
        global $ShowAllEventLimitedStatement;
        global $fromnumber;
        global $nbrElem;
        if ($ShowAllEventLimitedStatement->execute()) {
            while ($obj = $ShowAllEventLimitedStatement->fetchObject()) {
                $eventObj = new Event($obj->idEvent, $obj->titleEvent, $obj->logoEvent, $obj->lieuEvent, $obj->lieuEventPic, $obj->datedebutEvent, $obj->datefinEvent);
                $EventTable[] = $eventObj;
            }
            return $EventTable;
        }
    }

    public function ShowEvent($id)
    {
        global $ShowEventStatement;
        global $idEvent;
        $idEvent = $id;
        if ($ShowEventStatement->execute()) {
            while ($obj = $ShowEventStatement->fetchObject()) {
                $eventObj = new Event($obj->idEvent, $obj->titleEvent, $obj->logoEvent, $obj->lieuEvent, $obj->lieuEventPic, $obj->datedebutEvent, $obj->datefinEvent);
            }
            return $eventObj;
        }
    }

    public function deleteEvent($id)
    {
        global $deleteEventStatement;
        global $idEvent;
        $idEvent = $id;
        if ($deleteEventStatement->execute()) {
            return 1;
        }else{
            return 0;
        }
    }

    public function addEvent($obj)
    {
        global $addEventStatement;
        global $titleEvent;
        global $logoEvent;
        global $lieuEvent;
        global $lieuEventPic;
        global $datedebutEvent;
        global $datefinEvent;

        $titleEvent = $obj->titleEvent;
        $logoEvent = $obj->logoEvent;
        $lieuEvent = $obj->lieuEvent;
        $lieuEventPic = $obj->lieuEventPic;
        $datedebutEvent = $obj->datedebutEvent;
        $datefinEvent = $obj->datefinEvent;

        if ($addEventStatement->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateEvent($id,$obj)
    {
        global $updateEventStatement;
        global $idEvent;
        global $titleEvent;
        global $logoEvent;
        global $lieuEvent;
        global $lieuEventPic;
        global $datedebutEvent;
        global $datefinEvent;

        $idEvent = $id;

        $titleEvent = $obj->titleEvent;
        $logoEvent = $obj->logoEvent;
        $lieuEvent = $obj->lieuEvent;
        $lieuEventPic = $obj->lieuEventPic;
        $datedebutEvent = $obj->datedebutEvent;
        $datefinEvent = $obj->datefinEvent;

        if ($updateEventStatement->execute()) {
            return 1;
        } else {
            return 0;
        }

    }
}

//$ev = new EventDAO();
//print_r($ev->ShowAllEvents());
//echo "\n";
//print_r($ev->ShowEvent(1));

//echo $ev->deleteEvent(100);

