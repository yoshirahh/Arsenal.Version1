<?php
if(isset($_POST['choice']) && !empty($_POST['choice'])) {
	require_once( "./PHPMailer/class.phpmailer.php" );
	$message = "Here are some details of a recent donation attempt: ";
	$message .= "Amount = $" . $_POST['donation'];
	if ($_POST['choice'] == 1) {
		$message .= " | Do they want a poster? Yes.";
		if ($_POST['delivery'] == 1) {
			$message .= " | They want it delivered to: " . $_POST['address'];
		} else {
			$message .= " | They want it delivered to: Music Mart.";
		}
	} else {
		$message .= " | Do they want a poster? No.";
	}
	
	$message .= " | MAKE SURE TO CHECK THIS DATA WITH PAYPAL FOR VALIDITY.";
	
	$mail = new PHPMailer();
	$mail->IsHTML( true );
	$mail->From = "do-not-reply@arsenalperformingarts.org ";
	$mail->FromName = "Arsenal Postmaster ";
	$mail->Subject = "Brass Campaign Donation Started";
	$mail->Body = $message;
	$mail->AddAddress( "contact@arsenalperformingarts.org" );
	$mail->Send();
}
?>