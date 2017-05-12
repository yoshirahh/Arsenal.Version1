<?php
/**
 * groupsubmit.php | Created: 10/06/2016 | Updated: 10/06/2016
 *
 * @author Neil Sparks
 * 
 * This file is called upon submitting a form generated for group event registration.
 *
 * The file connects to the records database and fetches the appropriate data
 * regarding school ID, and attempts to find a registrant with the given unique
 * email. If this person exists, it will update any changed information in the
 * instrumentation and event registration log. 
 *
 * Finally, the process will create a unique hidden value for a PayPal button, 
 * and send off a confirmation email to the registrant, and an alert to the 
 * event administrator.
 */
 // Include relevant event functions
require_once('./events.php');

// Create a database connection to _records
$conn   = create_conn("records");
$info   = $_POST;
$email  = $_POST['email'];
$error  = 0;

// Fetch the school ID from _records.schools
$sql = "SELECT * FROM  `schools` WHERE  `school_name` = '".$info['school']."'";
$return = mysqli_query($conn, $sql);
if($return === FALSE) {
	$error = 4; 
	echo json_encode($error);
} else if(mysqli_num_rows($return) > 0) {
	$temp = mysqli_fetch_row($return);
	$school_id = $temp[0];
} else {
	$sql = "INSERT INTO `schools` (school_name) VALUES ('".$info['school']."')";
	mysqli_query($conn, $sql);
	$school_id = mysqli_insert_id($conn);
}

 // Insert new group in _records.groups
 $sql = "SELECT * FROM `groups` WHERE `contact_email` = '".$info['email']."'";
 $return = mysqli_query($conn, $sql);
if($return === FALSE) {
	$error = 5;
	echo json_encode($error);
} else {
	$sql = 	"INSERT INTO `groups` 
				(`contact_name`,`contact_email`,`school_id`,`city`,`unit_name`,`member_count`,`member_cost`,`staff`,`event_id`) 
			VALUES 
				('".$info['contact']."','".$info['email']."','$school_id','".$info['city']."','".mysqli_real_escape_string($conn, $info['name'])."','".$info['performers']."','".$info['total_fee']."','".mysqli_real_escape_string($conn, $info['staff_info'])."','".$info['ev_id']."')";
	if(mysqli_query($conn, $sql) === FALSE) {
		$error = 6; 
		echo json_encode($error);
	}
}

  // Update values in _records.events
$sql = "SELECT * FROM `events` WHERE `event_id`=".$info['ev_id'];
$return = mysqli_query($conn,$sql);
$event = mysqli_fetch_row($return);
$sql = "SELECT * FROM `groups` WHERE `event_id`=".$info['ev_id'];
$return = mysqli_query($conn,$sql);
$new_regs = mysqli_num_rows($return);
$sql = "UPDATE `events` SET registrants = $new_regs WHERE `event_id`=".$info['ev_id'];
if(mysqli_query($conn,$sql) === FALSE) $error = 2;

 // Generate unique id for PayPal button
$paypal_code = get_paypal_code($conn,$info['ev_id']);
if($paypal_code === 1) {
	$error = 2;
	mail("tech@arsenalperformingarts.org", "No PayPal Button Set Up", "It seems $email tried to register, but there is no way for them to pre-pay set up. Get on it!");
	echo json_encode($error);
}

// Select confirmation email filename to send
$sent_mail = get_event_email($conn,$info['ev_id']);
if($sent_mail === 1) {
	$error = 4;
	mail("tech@arsenalperformingarts.org", "No Payment Email Set Up", "It seems $email tried to register, but there is no payment email available. Get on it!");
	echo json_encode($error);	
}
mysqli_close($conn);
 
$error = 0;
if($error > 0) {
	echo json_encode($error);
} else {
	// Draft and send payment email, with attachments
	$email_fp = "../emails/$sent_mail";	
	$fp = fopen($email_fp, "r+");
	$message1 = fread($fp,10024);
	fclose($fp);
	  $message1 = str_replace("__firstname",$info["name"],$message1);
	  $message1 = str_replace("__unique_code",$paypal_code,$message1);
	  
	require_once("./PHPMailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->From      = "contact@arsenalperformingarts.org";
	$mail->FromName  = "Arsenal Performing Arts";
	$mail->Subject   = "$event[1] Registration";
	$mail->Body      = "$message1";
	$mail->AddAddress($email);
	
	// Add attachments and send
	$file_to_attach = "../downloads/2015 DrumLine Battle Rulebook.pdf";
	$mail->AddAttachment( $file_to_attach , "2015 DrumLine Battle Rulebook.pdf" );
	$file_to_attach = "../downloads/Participation Agreement 2016.pdf";
	$mail->AddAttachment( $file_to_attach , "Participation Agreement 2016.pdf" );
	$file_to_attach = "../downloads/Performer Release 2016.pdf";
	$mail->AddAttachment( $file_to_attach , "Performer Release 2016.pdf" );
	$mail->Send();
	
	// Draft and send back-end notification email
	
	$fp = fopen("../emails/groupNotify.php", "r+");
	$message = fread($fp,10024);
	fclose($fp);
	  $message = str_replace("__name",$info["contact"],$message);
	  $message = str_replace("__email",$info["email"],$message);
	  $message = str_replace("__school",$info["school"],$message);
	  $message = str_replace("__unit",$info["name"],$message);
	  $message = str_replace("__city",$info["city"],$message);
	  $message = str_replace("__performers",$info["performers"],$message);
	  $message = str_replace("__cost",$info["total_fee"],$message);
	  $message = str_replace("__staff",$info["staff_info"],$message);
	  $message = str_replace("__event",$event[1],$message);
	
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->From      = "do-not-reply@arsenalperformingarts.org";
	$mail->FromName  = "Arsenal Postmaster";
	$mail->Subject   = "New Registration for $event[1]";
	$mail->Body      = "$message";
	$mail->AddAddress("contact@arsenalperformingarts.org");
	$mail->Send();

echo json_encode($error);
}
?>