<?php
/**
 * Created by PhpStorm.
 * User: shmayro
 * Date: 23/12/15
 * Time: 06:07
 */
include "../Imports.php";
foreach ($_POST as $key => $value)
    echo "Field " . htmlspecialchars($key) . " is " . htmlspecialchars($value) . "<br>";

Field titleEvent is regerg
Field logoEvent is greg
Field lieuEvent is egrg
Field imgEvent is http://har.com
Field datedebutInsc is gregreg
Field datefinInsc is greg
Field datedebutEvent is gferg
Field datefinEvent is gerg
if (isset($_POST["titleEvent"]) && isset($_POST["logoEvent"]) && isset($_POST["lieuEvent"]) && isset($_POST["imgEvent"]) && isset($_POST["datedebutInsc"]) && isset($_POST["datefinInsc"]) && isset($_POST["datedebutEvent"]) && isset($_POST["datefinEvent"]) && isset($_POST["idEv"])){
    $genre=$_POST["genre"];
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $expLvl=$_POST["expLvl"];
    $email=$_POST["email"];

    $tel=isset($_POST["tel"])?$_POST["tel"]:"";
    $adressePost=isset($_POST["adressePost"])?$_POST["adressePost"]:"";
    $dept=$_POST["dept"];
    $pays=$_POST["pays"];
    $totaldays=$_POST["totaldays"];
    $idEv=$_POST["idEv"];
    $repas="";
    for($i=0;$i<$totaldays;$i++){
        if(isset($_POST["day$i"]))
            $repas=$repas."1";
        else
            $repas=$repas."0";
    }

    $inscObj=new Inscription($idEv,0,$genre,$nom,$prenom,$expLvl,$email,$tel,$adressePost,$dept,$pays,$repas,0);
    if($InscDAO->ShowInscriptionemail($inscObj->email)==null){

    $etatInscr=$InscDAO->addInscription($inscObj);
        //echo $etatInscr;
        if($etatInscr==1){
        ?><div id='confirmsg' class="alert alert-success" role="alert">Inscription Accéptée !! , Vous recevrez votre Invitation par Email.</div><?php
    }else{
        ?><div id='confirmsg' class="alert alert-danger" role="alert">Erreur !! ,Inscription Annulée</div><?php
    }}else{
    ?>
        <div id='confirmsg' class="alert alert-danger" role="alert">Deja Inscrit !! ,Inscription Annulée</div>
<?php
}}else{

    ?><div id='confirmsg' class="alert alert-warning" role="alert">Formulaire Incomplet, Inscription Annulée</div><?php }
    //foreach ($_POST as $key => $value)
    //    echo "Field " . htmlspecialchars($key) . " is " . htmlspecialchars($value) . "<br>";
?>