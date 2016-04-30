
<?php
require("class.phpmailer.php");

function send_mail($to_address, $to_name, $subject, $message) {
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->SMTPSecure = 'ssl';
		                                  // set mailer to use SMTP
	$mail->Host = "smtp.gmail.com";  // specify main and backup server
	$mail->Port = 465;
	$mail->Username = "tabulaturi.romanesti@gmail.com";  // SMTP username
	$mail->Password = "#tabulaturi"; // SMTP password

	$mail->From = "tabulaturi.romanesti@gmail.com";
	$mail->FromName = "Tabulaturi Românești";

	$mail->AddAddress($to_address, $to_name);

	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->CharSet = "UTF-8";

	$mail->Subject = $subject;
	$mail->Body    = $message;

	$result = true;
	if(!$mail->Send()) {
		$result = false;
		exit;
	}

	return $result;
}
?>
