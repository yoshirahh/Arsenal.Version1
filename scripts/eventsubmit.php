<?php
/**
 * eventsubmit.php | Created: 9/15/2016 | Updated: 03/12/2016
 *
 * @author Neil Sparks
 * 
 * This file is called upon submitting a form generated for individual event registration.
 *
 * The file connects to the records database and fetches the appropriate data
 * regarding school ID, and attempts to find a registrant with the given unique
 * email. If this person exists, it will update any changed information in the
 * instrumentation and event registration log. 
 *
 * Finally, the process will create a unique hidden value for a PayPal button, 
 * and send off a confirmation email to the registrant, and an alert to the 
 * event administrator.
 *
 * Future features: automatic attachment of materials. (10/06/16)
 *
 */

// Include relevant event functions
require_once( './events.php' );

// Initialize all default values before setting with new ones
$person = initialize_default_active();

// Set up new profile with give POST data
$person = set_new_active( $_POST, $person );

// Create a database connection to _records
$conn = create_conn( "records" );
$ev_id = $_POST[ 'ev_id' ];
$email = $person[ 'email' ];
$parent_email = $person[ 'parent_email' ];
$error = 0;

// Fetch the school ID from _records.schools
$sql = "SELECT * FROM  `schools` WHERE  `school_name` = '" . $person[ 'school_id' ] . "'";
$return = mysqli_query( $conn, $sql );
if ( $return === FALSE )echo 4;
if ( mysqli_num_rows( $return ) > 0 ) {
	$temp = mysqli_fetch_row( $return );
	$person[ 'school_id' ] = $temp[ 0 ];
} else {
	$sql = "INSERT INTO `schools` (school_name) VALUES ('" . $person[ 'school_id' ] . "')";
	mysqli_query( $conn, $sql );
	$person[ 'school_id' ] = mysqli_insert_id( $conn );
}

// Insert|Update data in _records.actives
$sql = "SELECT * FROM `actives` WHERE `email`='" . $person[ 'email' ] . "'";
$return = mysqli_query( $conn, $sql );
$num = mysqli_num_rows( $return );
if ( $return === FALSE )$error = 5;
else if ( mysqli_num_rows( $return ) > 0 ) {
	$update_flag = TRUE;
	$active = mysqli_fetch_row( $return );
	// Insert data into _records.activesEvents
	$error = add_event_log( $conn, intval( $active[ 0 ] ), intval( $ev_id ) );
} else {
	// Extract and convert data to strings, sanitizing the input
	$columns = implode( ", ", array_keys( $person ) );
	$escaped_values = array_values( $person );
	$values = implode( "', '", $escaped_values );
	$sql = "INSERT INTO `actives` ($columns) VALUES ('$values')";
	mysqli_query( $conn, $sql );
	$sql = "SELECT * FROM `actives`	WHERE `email` = '" . $email . "'";
	$return = mysqli_query( $conn, $sql );
	$active = mysqli_fetch_row( $return );

	// Insert data into _records.activesEvents
	$error = add_event_log( $conn, intval( $active[ 0 ] ), intval( $ev_id ) );
}

// Update values in _records.events
$sql = "SELECT * FROM `events` WHERE `event_id` = " . $ev_id;
$return = mysqli_query( $conn, $sql );
$event = mysqli_fetch_row( $return );
$sql = "SELECT * FROM `activesEvents` WHERE `event_id` = " . $ev_id;
$return = mysqli_query( $conn, $sql );
$new_regs = mysqli_num_rows( $return );
$sql = "UPDATE `events`	SET registrants = $new_regs WHERE `event_id` = " . $ev_id;
if ( mysqli_query( $conn, $sql ) == FALSE )$error += 2;

// Generate unique id for PayPal button
$paypal_code = get_paypal_code( $conn, $ev_id );
if ( $paypal_code === 1 ) {
	$error = 2;
	mail( "neil.sparks.95@gmail.com ", "No PayPal Button Set Up ",
		"It seems $email tried to register, but there is no way for them to pre - pay set up . Get on it!" );
	echo json_encode( $error );
}

// Select confirmation email filename to send
$sent_mail = get_event_email( $conn, $ev_id );
if ( $sent_mail === 1 ) {
	$error = 4;
	mail( "neil.sparks.95@gmail.com", "No Payment Email Set Up ",
		"It seems $email tried to register, but there is no payment email available . Get on it!" );
	echo json_encode( $error );
}
mysqli_close( $conn );

if ( $error > 1 ) {
	mail( "neil.sparks.95@gmail.com", "Error code alert!", "An unwarranted error code has been thrown: " . $error );
	echo json_encode( $error );
} else {
	require_once( "./PHPMailer/class.phpmailer.php" );
	if ( $sent_mail != null ) {
		// Draft and send payment email
		$email_fp = "../emails/" . $sent_mail;
		$fp = fopen( $email_fp, 'r+' );
		$message1 = fread( $fp, 10024 );
		fclose( $fp );
		$message1 = str_replace( "__firstname", $person[ 'first_name' ], $message1 );
		$message1 = str_replace( "__unique_code", $paypal_code, $message1 );

		$mail = new PHPMailer();
		$mail->IsHTML( true );
		$mail->From = "do-not-reply@arsenalperformingarts.org";
		$mail->FromName = "Arsenal Performing Arts";
		$mail->Subject = $event[ 1 ] . " Registration";
		$mail->Body = $message1;
		$mail->AddAddress( $email );
		$mail->Send();

		$mail = new PHPMailer();
		$mail->IsHTML( true );
		$mail->From = "do-not-reply@arsenalperformingarts.org";
		$mail->FromName = "Arsenal Performing Arts";
		$mail->Subject = $event[ 1 ] . " Registration [Parental Copy]";
		$mail->Body = $message1;
		$mail->AddAddress( $parent_email );
		$mail->Send();
	}
	// Draft and send back-end notification email
	$i1 = instrument_switch( $person[ 'primary_instrument' ] );
	$i2 = instrument_switch( $person[ 'secondary_instrument' ] );

	$fp = fopen( "../emails/dualNotify.php", 'r+' );
	$message = fread( $fp, 10024 );
	fclose( $fp );
	$message = str_replace( "__namel", $person[ 'last_name' ], $message );
	$message = str_replace( "__namef", $person[ 'first_name' ], $message );
	$message = str_replace( "__email", $person[ 'email' ], $message );
	$message = str_replace( "__school", $person[ 'school_id' ], $message );
	$message = str_replace( "__prime", $i1, $message );
	$message = str_replace( "__second", $i2, $message );
	$message = str_replace( "__event", $event[ 1 ], $message );

	$mail = new PHPMailer();
	$mail->IsHTML( true );
	$mail->From = "do-not-reply@arsenalperformingarts.org ";
	$mail->FromName = "Arsenal Postmaster ";
	$mail->Subject = "New Registration for " . $event[ 1 ];
	$mail->Body = $message;
	$mail->AddAddress( "contact@arsenalperformingarts.org" );
	$mail->Send();

	echo json_encode( $error );
}
?>