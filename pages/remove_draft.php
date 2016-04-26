/* This script will remove a draft from the database and the file on the disk */

<?php
    include '../includes/functions.php';
    connectDB();

    $id_draft= $_POST['id_draft'];
    $cale_draft = $_POST['cale_draft'];

    mysql_query("DELETE FROM `drafts` WHERE `id` = '$id_draft'");
    unlink("../" . $cale_draft);
?>
