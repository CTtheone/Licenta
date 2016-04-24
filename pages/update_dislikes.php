<?php
	include '../includes/functions.php';
	connectDB();
	
	$id_song = $_POST['uid'];
	$value = $_POST['val'];
	$query = $_POST['query'];
	$username = $_POST['username'];
	$titlu = $query['titlu'];
	$artist = $query['artist'];
	$uploader = $query['uploader'];
	
    mysql_query("UPDATE `melodii` SET `minus`='$value' WHERE `id`='$id_song'");
	
	mysql_query("INSERT INTO `rating` VALUES ('$username', '$titlu', '$artist', '$uploader', '2', NULL)");
?>