<?php
    include '../includes/functions.php';
    connectDB();

    $id_song = $_POST['id_song'];
    $cale_tmp = $_POST['cale_tmp'];
    $cale = $_POST['cale'];
    $action = $_POST['action'];
    $titlu = $_POST['titlu'];
    $artist = $_POST['artist'];
    if (strpos($action, 'accept') !== false) {
        accept();
    } else {
        decline();
    }

    function accept() {
        global $cale, $id_song, $cale_tmp;
        mysql_query("UPDATE `melodii` SET `cale` = '$cale', `cale_tmp` = NULL WHERE `id` = '$id_song' ");
        rename("../" . $cale_tmp, "../" . $cale);

        handle_requests();

        exit;
    }

    function decline() {
        global $cale_tmp, $id_song;
        mysql_query("DELETE FROM `melodii` WHERE `id` = '$id_song'");
        unlink("../" . $cale_tmp);
        exit;
    }

    function handle_requests() {
        global $id_song, $titlu, $artist;

        // check if there is a request of the now approved chord
        $res = mysql_query("SELECT `id` FROM `cereri` WHERE `artist` = '$artist' and `titlu` = '$titlu'");
        if (mysql_num_rows ($res) > 0) {
            $id = mysql_fetch_array($res)[0];

            // obtain a list with all the submitters
            $result = mysql_query("SELECT `username` FROM `abonari` WHERE `id_cerere` = '$id'");//
            $subs = array();
            while($p = mysql_fetch_array($result)){
                $subs[] = $p;
            }

             // send an email to all the submitters
            require_once("../includes/sendMail.php");
            $link = "index.php?song=" . $id_song;
            foreach($subs as $s) {
                $username = $s['username'];

                // get the email addres of the user
                $r = mysql_query("SELECT email FROM users WHERE username='$username'");
                $email = mysql_fetch_array($r)[0];

                $txt = 'Bună ziua,<br><br>A fost încarcată tabulatura: <b>' . $artist . " - " . $titlu . "</b><br><br> Aceasta poate fi accesată la url-ul:<br>" . $link;

                $r = send_mail($email, $username, 'Tabulaturi - Tabulatură nouă încarcată', $txt);
            }

            // remove the request from 'cereri' and from 'abonati'
            mysql_query("DELETE FROM `cereri` WHERE `id` = '$id'");
            mysql_query("DELETE FROM `abonari` WHERE `id_cerere` = '$id'");
        }
    }
?>
