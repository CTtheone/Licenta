<?php

function connectDB(){
    mysql_connect("localhost","root","cosmin") or die("Conectare esuata la MYSQL!");
    mysql_select_db("licenta");
}

function getUser($username){
    connectDB();
    $result = mysql_query("SELECT * FROM users WHERE username='$username'");
    return mysql_fetch_array($result);
}

function signUp($username, $password, $email){
    $user = getUser($username);

    if($user)
        return false;
    else {
        $password = md5($password);
        mysql_query("INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, '$username', '$password', '$email');");
        return true;
    }
}

function logIn($username, $password) {
    $user = getUser($username);

    if($user){
        if($user['password'] == md5($password)){
            return $user;
        }
        else return null;
    }
    else return null;
}

function sendEmail($to, $from, $subject, $txt) {

    $post = [
            'to'    => $to,
            'from'  => $from,
            'text'  => $txt,
            'subject' => $subject,
    ];

    $ch = curl_init('https://api.mailgun.net/v3/samples.mailgun.org/messages');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, 'api' . ":" . 'key-3ax6xnjp29jd6fds4gc373sgvjxteol0');

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    if (strpos($response, 'Thank you') !== false) {
        return true;
    }
    return false;
    // $command = "curl -s --user 'api:key-3ax6xnjp29jd6fds4gc373sgvjxteol0'     https://api.mailgun.net/v3/samples.mailgun.org/messages " .
    // " -F from=" . $from . " -F to=" . $to . " -F subject=" . $subject . " -F text=" . $txt;
    // $output = shell_exec($command);
    // if (strcmp($response, 'Forbidden') == 0)
    //         return false;
    // return true;
}

function requestChords($artist, $titlu) {
	connectDB();
	mysql_query("INSERT INTO `cereri` (`id`, `artist`, `titlu`) VALUES (NULL, '$artist', '$titlu');");
	return true;
}

function uploadFile($username, $artist, $titlu, $categorie, $text) {
    $filename = "tmp_upload/" . $username . "_" . $artist . "_" . $titlu . ".txt";
    $comments = "comments/" . $artist . "_" . $titlu . "_comm.txt";
	connectDB();
	mysql_query("INSERT INTO `melodii` (`id`, `artist`, `titlu`, `cale_tmp`, `cale`, `categorie`, `uploader`, `plus`, `minus`,`comments_path`) VALUES (NULL, '$artist', '$titlu', '$filename', NULL, '$categorie', '$username', 0, 0, '$comments');");
    $f1 = fopen($filename, "w");
    $r1 = fwrite($f1, $text);
    $r2 = fclose($f1);
    return $f1 && $r1 && $r2;
}

function get_artists_by_first_letter($letter) {
    connectDB();
    if($letter != "#") {
        $result1 = mysql_query("SELECT DISTINCT artist FROM melodii WHERE artist like '$letter%' and cale is not NULL");
        $result2 = mysql_query("SELECT DISTINCT artist FROM cereri WHERE artist like '$letter%'");
    }
    else {
        $result1 = mysql_query("SELECT DISTINCT artist FROM melodii WHERE artist REGEXP '^[0-9]' and cale is not NULL");
        $result2 = mysql_query("SELECT DISTINCT artist FROM cereri WHERE artist REGEXP '^[0-9]'");
    }
    //ISNUMERIC(LEFT(artist, 1)) = 1

    $artists = array();
    while($p = mysql_fetch_array($result1)){
        $artists[] = $p;
    }
    while($p = mysql_fetch_array($result2)){
        $artists[] = $p;
    }
    return array_unique($artists, SORT_REGULAR);
}

function get_numberOf_tabs_by_artist($artist){
    connectDB();
    $result = mysql_query("SELECT COUNT(*) as nr FROM melodii WHERE artist='$artist' and cale is not NULL");
    return mysql_fetch_array($result)['nr'];
}

function get_numberOf_requests_by_artist($artist){
    connectDB();
    $result = mysql_query("SELECT COUNT(*) as nr FROM cereri WHERE artist='$artist'");
    return mysql_fetch_array($result)['nr'];
}

function get_songs_by_category($category) {
    connectDB();
    $result = mysql_query("SELECT * FROM melodii WHERE categorie='$category' and cale is not NULL order by titlu, artist");

    $songs = array();
    while($p = mysql_fetch_array($result)){
        $songs[] = $p;
    }
    return $songs;
}

function get_song_by_id($id_song) {
    connectDB();
    $result = mysql_query("SELECT * FROM melodii WHERE id='$id_song' and cale is not NULL");
    return mysql_fetch_array($result);
}

function get_songs_by_artist($artist) {
    connectDB();
    $result = mysql_query("SELECT * FROM melodii WHERE artist='$artist' and cale is not NULL order by titlu");

    $songs = array();
    while($p = mysql_fetch_array($result)){
        $songs[] = $p;
    }
    return $songs;
}

function get_songs_by_uploader($uploader) {
    connectDB();
    $result = mysql_query("SELECT * FROM melodii WHERE uploader='$uploader' and cale is not NULL order by titlu");

    $songs = array();
    while($p = mysql_fetch_array($result)){
        $songs[] = $p;
    }
    return $songs;
}

function get_requests_by_artist($artist){
    connectDB();
    $result = mysql_query("SELECT * FROM cereri WHERE artist='$artist' order by titlu");

    $songs = array();
    while($p = mysql_fetch_array($result)){
        $songs[] = $p;
    }
    return $songs;
}

function get_result_of_search($item) {
    connectDB();
    $result1 = mysql_query("SELECT * FROM melodii WHERE UPPER(artist) like UPPER('$item%') and cale is not NULL order by titlu");
    $result2 = mysql_query("SELECT * FROM melodii WHERE UPPER(categorie) like UPPER('$item%') and cale is not NULL order by titlu, artist");
    $result3 = mysql_query("SELECT * FROM melodii WHERE UPPER(titlu) like UPPER('$item%') and cale is not NULL order by titlu, artist");

    $items = array();
    while($p = mysql_fetch_array($result1)){
        $items[] = $p;
    }
    while($p = mysql_fetch_array($result2)){
        if (!in_array($p, $items))
            $items[] = $p;
    }
    while($p = mysql_fetch_array($result3)){
        if (!in_array($p, $items))
            $items[] = $p;
    }
    return $items;
}

function check_already_like($query, $user) {
	connectDB();

	$titlu = $query['titlu'];
	$artist = $query['artist'];
	$uploader = $query['uploader'];

	$new_query = mysql_query("SELECT * FROM rating WHERE artist='$artist' and titlu='$titlu' and uploader='$uploader' and username='$user'");
	$fetch = mysql_fetch_array($new_query);
	if (!$fetch) {
		return 0;
	} else {
		return $fetch['likes'];
	}
}

function add_new_comm($user, $file, $new_comm) {
	date_default_timezone_set('Europe/Bucharest');
	$date = date('Y-m-d H:i:s');

	if(!$file) {
	    echo "Ne pare rau! Mesajul nu a putut fi adăugat.";
	    return;
	}
	if(!file_exists($file))
	    $fp = fopen($file, "w");

	if (filesize($file) > 0) {
	$current = file_get_contents($file, NULL, NULL, 0, filesize($file));
	$current .= "$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$\r\n";
	} else {
	    $current = "$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$\r\n";
	}
	$current .= $user['username']."\t".$date."\r\n";
	$current .= $new_comm."\r\n";
	file_put_contents($file, $current, LOCK_EX);
}

function display_comm($comments_file) {
    if($comments_file && file_exists($comments_file)) {
        $file = fopen($comments_file, "r");

        if (filesize($comments_file) > 0){
            $contents = fread($file, filesize($comments_file));
            $comm = preg_split("/[$]+\r\n/", $contents);
            for($i = 1; $i < count($comm); $i++) {
            	$array = explode("\r\n", $comm[$i], 2);
            	$uploader = "<a class='comment' style='margin:0px;color:black;margin-left:100px;'>" . $array[0] . "</a>";
            	$mesaj = "<pre class='comment'>".$array[1]."</pre>";
            	echo $uploader."<br/>";
            	echo $mesaj;
            }
        }
        fclose($file);
	}
	echo "<br/>";
}

function get_email_of_user($username) {
    connectDB();
    $result = mysql_query("SELECT email FROM users WHERE username='$username'");
    return mysql_fetch_array($result)[0];
}

function upload_draft($username, $artist, $titlu, $text) {
    $filename = "drafts/" . $username . "_" . $artist . "_" . $titlu . ".txt";
	connectDB();
	mysql_query("INSERT INTO `drafts` (`id`, `artist`, `titlu`, `cale`, `uploader`) VALUES (NULL, '$artist', '$titlu', '$filename', '$username');");
    $f1 = fopen($filename, "w");
    $r1 = fwrite($f1, $text);
    $r2 = fclose($f1);
    return $f1 && $r1 && $r2;
}

function get_drafts_of_uploader($username) {
    connectDB();
    $result = mysql_query("SELECT * FROM drafts WHERE uploader='$username' order by titlu");

    $songs = array();
    while($p = mysql_fetch_array($result)){
        $songs[] = $p;
    }
    return $songs;
}

function get_draft_by_id($id_song) {
    connectDB();
    $result = mysql_query("SELECT * FROM drafts WHERE id='$id_song'");
    return mysql_fetch_array($result);
}

function is_user_admin($username) {
    connectDB();
    $result = mysql_query("SELECT admin FROM users WHERE username='$username'");
    return $result;
}

function get_all_tmp_songs() {
    connectDB();
    $result = mysql_query("SELECT * FROM melodii WHERE cale is NULL and cale_tmp is not NULL order by titlu");

    $songs = array();
    while($p = mysql_fetch_array($result)){
        $songs[] = $p;
    }
    return $songs;
}

function get_tmp_song_by_id($id_song) {
    connectDB();
    $result = mysql_query("SELECT * FROM melodii WHERE id='$id_song'");
    return mysql_fetch_array($result);
}

?>
