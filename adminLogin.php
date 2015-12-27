<?php
/**
 * Created by PhpStorm.
 * User: Haroun
 * Date: 25/12/2015
 * Time: 17:35
 */
include "Imports.php";
if(isset($_POST["username"]) && isset($_POST["pass"])) {
    $user=$_POST["username"];
    $pass=$_POST["pass"];
    $pass=crypt($pass,$cryptingKey);
    $masterverif=$db->prepare("select COUNT(*) as num from master where username=:username and pass=:pass");
    $masterverif->bindParam(":username",$user);
    $masterverif->bindParam(":pass",$pass);
    if($masterverif->execute()){
        $num=$masterverif->fetchObject()->num;
        if($num==1){
            session_start();
            $_SESSION["admn"]=$user;
            $_SESSION["start"]=time();
            $_SESSION["expire"]=$_SESSION["start"]+(5 * 60);
            header("location:adminPannel.php");
        }else{
            header("Refresh:0");
        }
    }
    $ShowInscriptionStatement->bindParam(":idInsc", $idInsc);
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form class="form-signin" action="adminLogin.php" method="post" >
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Email address</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
<?php } ?>