<?php
/**
 * Ajout d'une inscription A partir du formulaire InscFormModal.php
 */
include "../Imports.php";
if (isset($_POST["genre"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["expLvl"]) && isset($_POST["email"]) && isset($_POST["dept"]) && isset($_POST["pays"]) && isset($_POST["totaldays"]) && isset($_POST["idEv"])){
    //recuperation des donnees
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


    //generation du champq repas a partir des nombres de jours de l'event
    $repas="";
    for($i=0;$i<$totaldays;$i++){
        if(isset($_POST["day$i"]))
            $repas=$repas."1";
        else
            $repas=$repas."0";
    }

    //creation d'un objet inscription
    $inscObj=new Inscription($idEv,0,$genre,$nom,$prenom,$expLvl,$email,$tel,$adressePost,$dept,$pays,$repas,0);

    //verifier si l'inscrtion avec email existe deja
    if($InscDAO->ShowInscriptionemail($inscObj->idEvent,$inscObj->email)==null){

    //execution de la requete Ajout
    $etatInscr=$InscDAO->addInscription($inscObj);
        //echo $etatInscr;
        if($etatInscr==1){
            //Inscription ajouté !!
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