<?php
$servername = "localhost";
$username   = "arsemeoe_bot";
$password   = "DukeCityBot16";
$dbname     = "arsemeoe_events";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$info       = $_POST;
$namef      = $_POST['namef'];
$namel      = $_POST['namel'];
$dob        = $_POST['birth'];
$school     = $_POST['school'];
$prime      = $_POST['inst1'];
$second     = $_POST['inst2'];
$own        = $_POST['ownin'];
$email      = $_POST['email'];
$event_id   = $_POST['ev_id'];

$sql = "INSERT INTO `octClinic16` (name_f,name_l,dob,school,email,instrument_1,instrument_2,own_1)
  VALUES ('$namef','$namel','$dob','$school','$email','$prime','$second','own')";

/*$sql = "INSERT INTO `actives` (first_name,last_name,email,birthday,school_id)
	VALUES ('$namef','$namel','$email','$dob','$school')";
if (mysqli_query($conn,$sql) === FALSE) exit(1);
$sql = "SELECT `active_id` FROM `actives` WHERE `email`='$email'";
$reg_user = mysqli_fetch_row(mysqli_query($conn,$sql));
$sql = "INSERT INTO `activesEvents` ";
$sql = "SELECT * FROM `events` WHERE `event_id`=".intval($info['ev_id']);
$return = mysqli_query($conn,$sql);
$event = mysqli_fetch_row($return);*/

if (mysqli_query($conn,$sql) === TRUE) {
	$to         = "contact@arsenalperformingarts.org";
	$bcc        = "tech@arsenalperformingarts.org";
	$subject    = "New Registration for Arsenal October Clinic 2016";
	$email_from = "Arsenal Postmaster".'<'."tech@arsenalperformingarts.org".'>';
	$headers    = 'From: '.$email_from."\r\n";
	$headers   .= "BCC: ".$bcc."\r\n";
	$headers   .= "MIME-Version: 1.0\r\n";
	$headers   .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = mailprep($info);
	mail($to, $subject, $message, $headers);
	
	$fp = fopen("../emails/confirmationEmail.php", 'r+');
	$message = fread($fp,10024);
	fclose($fp);
	$message = str_replace("__firstname",$namef,$message);

	$email_from = "Arsenal Performing Arts, Inc.".'<'."contact@arsenalperformingarts.org".'>';
	$subject    = "Arsenal October Clinic 2016 Registration"; 

	mail($email, $subject, $message, $headers);
	
    echo json_encode(0);
} else {
    echo json_encode(2);
}
$conn->close();
function mailprep($info) {
	$i1         = 'N/A';
	$i2         = 'N/A';
	switch($info['inst1']) {
	  case 1:
		  $i1 = "Trumpet";
		  break;
	  case 2:
		  $i1 = "Mellophone";
		  break;
	  case 4:
		  $i1 = "Baritone/Euphonium";
		  break;
	  case 8:
		  $i1 = "Tuba";
		  break;
	  case 16:
		  $i1 = "Snare";
		  break;
	  case 32:
		  $i1 = "Tenors";
		  break;
	  case 64:
		  $i1 = "Bass";
		  break;
	  case 128:
		  $i1 = "Cymbals";
		  break;
	}
	switch($info['inst2']) {
	  case 1:
		  $i2 = "Trumpet";
		  break;
	  case 2:
		  $i2 = "Mellophone";
		  break;
	  case 4:
		  $i2 = "Baritone/Euphonium";
		  break;
	  case 8:
		  $i2 = "Tuba";
		  break;
	  case 16:
		  $i2 = "Snare";
		  break;
	  case 32:
		  $i2 = "Tenors";
		  break;
	  case 64:
		  $i2 = "Bass";
		  break;
	  case 128:
		  $i2 = "Cymbals";
		  break;
	}
	$fp = fopen("../emails/dualNotify.php", 'r+');
	
	$message = fread($fp,10024);
	
	fclose($fp);
	
	$message = str_replace("__namel",$info['namel'],$message);
	$message = str_replace("__namef",$info['namef'],$message);
	$message = str_replace("__email",$info['email'],$message);
	$message = str_replace("__school",$info['school'],$message);
	$message = str_replace("__prime",$i1,$message);
	$message = str_replace("__second",$i2,$message);
	$message = str_replace("__event",$event[1],$message);
	return $message;
}
?>