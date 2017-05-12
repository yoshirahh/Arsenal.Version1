<?php
if ( isset( $_POST[ 'name-volunteer' ] ) && isset( $_POST[ 'email-volunteer' ] ) && isset( $_POST[ 'phone-volunteer' ] ) && isset( $_POST[ 'groups-volunteer' ] ) ) {
	$name = $_POST[ 'name-volunteer' ];
	$email = $_POST[ 'email-volunteer' ];
	$phone = $_POST[ 'phone-volunteer' ];
	$message = $_POST[ 'messagearea' ];
	$checked = '';

	if ( !empty( $_POST[ 'groups-volunteer' ] ) ) {
		foreach ( $_POST[ 'groups-volunteer' ] as $v ) {
			$checked .= $v . ". ";
		}
	}

	require_once( "./PHPMailer/class.phpmailer.php" );

	$confirm_mail = new PHPMailer();
	$confirm_mail->IsHTML( true );
	$confirm_mail->From = "volunteer@arsenalperformingarts.org";
	$confirm_mail->FromName = "Arsenal Volunteer Coordinator";
	$confirm_mail->Subject = "Thank you for volunteering!";
	$confirm_mail->Body = "Thank you for reaching out to us through our volunteer form! <br /><br />This is just a quick message to let you know that we got your submission, and to confirm that this email address works. We will get ahold of you as events arise that require volunteers, as well as some potential volunteer newsletters. If you'd like to get ahold of us again, feel free to reply back directly to this message.<br /><br /><br />Thank you,<br /><br />Arsenal Volunteer Coordinator";
	$confirm_mail->AddAddress( "$email" );
	$confirm_mail->Send();

	$mail = new PHPMailer();
	$mail->IsHTML( true );
	$mail->From = "volunteer-form@arsenalperformingarts.org";
	$mail->addReplyTo( "$email", "$name" );
	$mail->FromName = "Arsenal Volunteer Form";
	$mail->Subject = "Volunteer Submission from $name";
	$mail->Body = "Awesome news! $name has voiced interest in volunteering for Arsenal. They have signed up to work for the following group(s): <strong>" . $checked . "</strong><br/><br/>Other information from the volunteer:<br/><em>$message</em><br/><br/>Sent from: $email<br/>Use \"Reply\" to respond to them.";
	$mail->AddAddress( "volunteer@arsenalperformingarts.org" );
	$mail->Send();

	$cookie_name = 'arsenal_org_volunteer_cookie';
	$cookie_value = 'TRUE';
	setcookie( $cookie_name, $cookie_value, time() + ( 10 * 30 ), '/' ); // 86400 = 1 day

	header( "Location: http://www.arsenalperformingarts.org/support#volunteer" );
} else {
	$cookie_name = 'arsenal_org_volunteer_cookie';
	$cookie_value = 'FALSE';
	setcookie( $cookie_name, $cookie_value, time() + ( 10 * 30 ), '/' ); // 86400 = 1 day
	header( "Location: http://www.arsenalperformingarts.org/support#volunteer" );
}
?>