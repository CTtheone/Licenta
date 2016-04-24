<?php
include '../includes/functions.php';

connectDB();
$id_song = $_POST['id_song'];
$cale_tmp = $_POST['cale_tmp'];
$cale = $_POST['cale'];
$action = $_POST['action'];
if (strpos($action, 'accept') !== false) {
    accept();
} else {
    decline();
}

function accept() {
    global $cale, $id_song;
    mysql_query("UPDATE `melodii` SET `cale` = '$cale', `cale_tmp` = NULL WHERE `id` = '$id_song' ");
    rename("../" . $cale_tmp, "../" . $cale);
    exit;
}

function decline() {
    global $cale_tmp, $id_song;
    mysql_query("DELETE FROM `melodii` WHERE `id` = '$id_song'");
    unlink("../" . $cale_tmp);
    exit;
}
?>
