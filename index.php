<?php
require_once './includes/functions.php';

session_start();
$mesaj_eroare_login="";

if(isset($_POST['connect'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = login($username, $password);

    if($user){
        $_SESSION['user']=$user;
        header("location: index.php");
    }else{
        $mesaj_eroare_login="<div class='alert alert-info' style='font-size:19px;width:230px;margin-left:340px'>User sau parolă greșite!</div>";
    }
}

if(isset($_GET['disconnect']) && isset($_SESSION['user'])){
    unset($_SESSION['user']);
    header("location: index.php");
}

if(isset($_SESSION['user']) && isset($_GET['addComm'])) {
        header("Location: index.php?song=".$_GET['addComm']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acorduri chitara</title>
        <script type="text/javascript" src="scripts/main.js"></script>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        if(isset($_SESSION['user'])){
            require_once './layouts/connected.php';
        }else{
            require_once './layouts/disconnected.php';
        }
        ?>
    </body>
</html>
