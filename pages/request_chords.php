<?php
if(!isset($_SESSION['user'])){
	print "<div class='alert alert-info' style='font-size:19px;width:485px;margin-left:220px;margin-top:110px'>Pentru a putea cere acorduri trebuie să fii autentificat.</div>";
} else {
	require_once './pages/request_logged_in.php';
}
?>
