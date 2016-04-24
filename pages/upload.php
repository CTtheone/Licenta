<?php
if(!isset($_SESSION['user'])){
	print "<div class='alert alert-info' style='font-size:19px;width:515px;margin-left:200px;margin-top:110px'>Pentru a putea încărca acorduri trebuie să fii autentificat.</div>";
} else {
	require_once './pages/upload_logged_in.php';
}
?>
