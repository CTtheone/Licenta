<?php
    include '../includes/functions.php';
    connectDB();

    $id_cerere = $_POST['id'];
    $username = $_POST['user'];

    mysql_query("INSERT INTO `abonari` VALUES ('$username', '$id_cerere')");
    exit;
?>
