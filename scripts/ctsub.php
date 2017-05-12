<?php
if ( isset( $_POST[ 'name-direct' ] ) && isset( $_POST[ 'email-direct' ] ) && isset( $_POST[ 'phone-direct' ] ) && isset( $_POST[ 'groups-direct' ] ) && isset( $_POST[ 'messagearea' ] )) {
	$name = $_POST[ 'name-direct' ];
	$email = $_POST[ 'email-direct' ];
	$phone = $_POST[ 'phone-direct' ];
	$group = $_POST[ 'groups-direct' ];
	$message = $_POST[ 'messagearea' ];
	$title = ucwords( $group );


	require_once( "./PHPMailer/class.phpmailer.php" );

	$confirm_mail = new PHPMailer();
	$confirm_mail->IsHTML( true );
	$confirm_mail->From = "contact@arsenalperformingarts.org";
	$confirm_mail->FromName = "Arsenal Performing Arts";
	$confirm_mail->Subject = "Thank you for your message!";
	$confirm_mail->Body = "Thank you for reaching out to us through our contact form! <br /><br />This is just a quick message to let you know that we got your submission, and to confirm that this email address works. You should hear back with us within 24-48 hours, and if not, feel free to reply back directly to this message.<br /><br /><br />Thank you,<br /><br />Arsenal Performing Arts";
	$confirm_mail->AddAddress( "$email" );
	$confirm_mail->Send();

	$mail = new PHPMailer();
	$mail->IsHTML( true );
	$mail->From = "contact-form@arsenalperformingarts.org";
	$mail->addReplyTo( "$email", "$name" );
	$mail->FromName = "Arsenal Contact Form";
	$mail->Subject = "Direct Email from $name | $title";
	$mail->Body = "$message <br/><br/>Sent from: $email<br/>Use \"Reply\" to respond to them.";
	$mail->AddAddress( "contact@arsenalperformingarts.org" );
	$mail->Send();

	$cookie_name = 'arsenal_org_contact_cookie';
	$cookie_value = 'TRUE';
	setcookie( $cookie_name, $cookie_value, time() + ( 10 * 30 ), '/' ); // 86400 = 1 day

	header( "Location: http://www.arsenalperformingarts.org/contact" );
} else {
	$cookie_name = 'arsenal_org_contact_cookie';
	$cookie_value = 'FALSE';
	setcookie( $cookie_name, $cookie_value, time() + ( 10 * 30 ), '/' ); // 86400 = 1 day

	header( "Location: http://www.arsenalperformingarts.org/contact" );
}
?>