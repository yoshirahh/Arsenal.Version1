<?php
function process_event()
{
  session_start();
  $servername     = "localhost";
  $username       = "arsemeoe_bot";
  $password       = "DukeCityBot16";
  $dbname         = "arsemeoe_payments";
  $tname          = "eventRegistration";
  $dbname1        = "arsemeoe_events";
  $tname1         = "octClinic16";
  $first_name     = $_SESSION['first_name'];
  $last_name      = $_SESSION['last_name'];
  $item_number    = $_SESSION['item_number'];
  $payment_status = $_SESSION['payment_status'];
  $payment_amount = $_SESSION['payment_amount'];
  $txn_id         = $_SESSION['txn_id'];
  $payer_email    = $_SESSION['payer_email'];
  $address_street = $_SESSION['address_street'];
  $address_city   = $_SESSION['address_city'];
  $address_state  = $_SESSION['address_state'];
  $address_zip    = $_SESSION['address_zip'];
  $item_number    = $_SESSION['item_number'];
  $custom         = $_SESSION['custom'];
  
   
  $paydb = mysqli_connect($servername, $username, $password, $dbname);
  
  $lookup = mysqli_query($paydb, "SELECT * FROM $tname WHERE `txn_id` = $txn_id");
  $row    = mysqli_fetch_assoc($lookup);
  if (mysqli_num_rows($lookup) == 0) {
    $sql = "INSERT INTO $tname (first_name, last_name, payer_email, address_street, address_city, address_state, address_zip, item_number, txn_id, payment_status)
	  VALUES ('$first_name', '$last_name', '$payer_email', '$address_street', '$address_city', '$address_state', '$address_zip', '$item_number', '$txn_id', '$payment_status')";
    if(mysqli_query($paydb, $sql)) {
		$message = "A new PayPal transaction has been recorded in our systems.\nGiven the barebones nature of our current transaction system, it is wise to check the transaction on paypal.com for any verification necessary.\nSummary of data:\nName:$first_name $last_name\nEmail: $payer_email\nItem purchased: $item_number (consult items listings in database, or documentation)\nTransaction ID: $txn_id\nPayment Amount: $payment_amount\nStatus of Payment: $payment_status";
		require_once("./PHPMailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsHTML(false);
		$mail->From      = "payments@arsenalperformingarts.org";
		$mail->FromName  = "Arsenal Payment Notification";
		$mail->Subject   = "New Purchase of Item #$item_number";
		$mail->Body      = "$message";
		$mail->AddAddress("contact@arsenalperformingarts.org");
		$mail->AddAddress("tech@arsenalperformingarts.org");
		$mail->Send();
	}
  $paydb->close();
  session_unset();
  session_destroy();
  }
}
?>