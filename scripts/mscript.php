<?php
  $servername = "localhost";
  $username = "arsemeoe_bot";
  $password = "DukeCityBot16";
  $dbname = "arsemeoe_members";
  $new_email = $_POST['email'];
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
  } 
  
  $sql = "INSERT INTO newsletter (email)
  VALUES ('$new_email')";
  
  if ($conn->query($sql) === TRUE) { 
	  echo "Awesome!<br/>You're now on the mailing list.";
  } else {
	  echo "Interesting!<br/>It appears you're already on the list." ;
  }
  
  $conn->close();
  
  $to      = $new_email;
  $subject = 'Thanks for signing up!';
  $message = 'This is a test email for signing up for the Arsenal Newsletter.';
  $headers = 'From: contact@arsenalperfromingarts.org' . "\r\n" .
	'Reply-To: contact@arsenalperformingarts.org' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
  
  mail($to, $subject, $message, $headers);
?>