<?php
if ( isset( $_POST[ 'id' ] ) ) {
	$id = $_POST[ 'id' ];
	$servername = "localhost";
	$username = "arsemeoe_bot";
	$password = "DukeCityBot16";
	$dbname = "arsemeoe_records";
	// Create connection
	$conn = new mysqli( $servername, $username, $password, $dbname );
	// Check connection
	if ( $conn->connect_error ) {
		die( "Connection failed: " . $conn->connect_error );
	}
	$query = "SELECT * FROM  `events` WHERE  `event_id` =$id";
	$result = mysqli_query( $conn, $query );
	$row = mysqli_fetch_row( $result );
	$conn->close();

	include_once( "./events.php" );

	$name = $row[ 1 ];
	$description = utf8_encode( $row[ 2 ] );
	$location = $row[ 3 ];
	$date = $row[ 6 ];

	$form = include_once( select_form( $id ) );

	echo json_encode( $form );
} else {
	error_log( "CODE 00EF01: eventgen.php did not receive an ID through post; inappropriate access detected.\n" );
	echo json_encode( "<h3>There appears to be an error.</h3><h5>Please email tech@arsenalperformingarts.org immediately with code 00EF01</h5>" );
}
?>