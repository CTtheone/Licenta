<?php
    include '../includes/functions.php';
    connectDB();

    $id_cerere = $_POST['id'];

    mysql_query("DELETE FROM `abonari` WHERE `id_cerere` = '$id_cerere'");
    exit;
?>
