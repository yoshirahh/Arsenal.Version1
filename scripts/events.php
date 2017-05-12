<?php

function create_conn( $db_suffix ) {
	$servername = "localhost";
	$username = "arsemeoe_bot";
	$password = "DukeCityBot16";
	$dbname = "arsemeoe_$db_suffix";
	// Create connection
	$conn = new mysqli( $servername, $username, $password, $dbname );
	// Check connection
	if ( $conn->connect_error ) {
		die( "Connection failed: " . $conn->connect_error );
	}
	return $conn;
}

function fetch_events() {
	$conn = create_conn( 'records' );
	$query = "SELECT * FROM  `events` WHERE  `open` =1";
	$open_events = mysqli_query( $conn, $query );

	$rows = array();

	$it = 0;
	while ( $row = mysqli_fetch_row( $open_events ) ) {
		$rows[ $it ] = $row;
		$it++;
	}
	$conn->close();
	return $rows;
}

function generate_events( $rows, $size ) {
	$id = 0;
	$num_rows = count( $rows );
	while ( $id < $num_rows ) {
		$unique = $rows[ $id ][ 0 ];
		$name = utf8_encode( $rows[ $id ][ 1 ] );
		$location = utf8_encode( $rows[ $id ][ 3 ] );
		$date = new DateTime( $rows[ $id ][ 6 ] );
		$duration = intval( $rows[ $id ][ 7 ] );

		if ( $duration > 1 ) {
			$when = '<h4>When: ' . $date->format( 'F j, Y' ) . ' to ' . $date->modify( '+' . ( intval( $duration ) - 1 ) . ' days' )->format( 'F j, Y' ) . '</h4>';
		} else {
			$when = '<h4>When: ' . $date->format( 'F j, Y' ) . '</h4>';
		}
		$id++;
		echo '<div class="col-sm-' . $size . '"><div class="event-item" id="event-' . $unique . '"><span style="content:none; float:left;" id="ev-logo"></span><h3>' . $name . '</h3>' . $when . '<h4>Where: ' . $location . '</h4><button class="button btn btn-arsenal registerNowButton" data-unique="' . $unique . '">Register Now</button></div></div>';
	}
}

function show_events( $rows, $size ) {
	$active = true;
	$num_rows = count( $rows );

	if ( $num_rows < 1 ) {
		$active = false;
	}

	if ( $active ) {
		generate_events( $rows, $size );
	} else {
		echo '<div class="col-sm-12" align="center"><h3>There are no active event registrations at this time.</h3></div>';
	}
}

function initialize_default_active() {
	$defaults = [
		"first_name" => "MISSING",
		"last_name" => "MISSING",
		"email" => "MISSING",
		"birthday" => "0000-00-00",
		"school_id" => 0,
		"primary_instrument" => NULL,
		"secondary_instrument" => NULL,
		"parent_first_name" => "MISSING",
		"parent_last_name" => "MISSING",
		"parent_email" => "MISSING",
	];
	return $defaults;
}

function set_new_active( $new_info, $person ) {
	$updated = $person;
	if ( ( count( $new_info ) ) != count( $person ) ) {
		error_log( "More variables were set than necessary in a submission form - insertion will fail. [" . count( $new_info ) . ", " . count( $person ) . "]" );
		echo( json_encode( 5 ) );
	} else {
		foreach ( $person as $key => $value ) {
			if ( !empty( $new_info[ $key ] ) )$updated[ $key ] = $new_info[ $key ];
		}
		unset( $key );
		unset( $value );
	}
//	mail( "tech@arsenalperformingarts.org", "TEST", array_keys($new_info) );
	return $updated;
}

function get_paypal_code( $conn, $ev_id ) {
	$sql = "SELECT * FROM `paypalButtons` WHERE `event_id` = $ev_id AND `active` = 1";
	$result = mysqli_query( $conn, $sql );
	if ( mysqli_num_rows( $result ) === 1 ) {
		$row = mysqli_fetch_row( $result );
		$paypal_code = $row[ 3 ];
		return $paypal_code;
	} else {
		return 1;
	}
}

function get_event_email( $conn, $ev_id ) {
	$sql = "SELECT * FROM `emails` WHERE `event_id` = $ev_id";
	$result = mysqli_query( $conn, $sql );
	if ( mysqli_num_rows( $result ) === 1 ) {
		$row = mysqli_fetch_row( $result );
		$filename = $row[ 2 ];
		return $filename;
	} else {
		return 1;
	}
}

function add_event_log( $conn, $id, $ev_id ) {
	$sql = "SELECT * FROM `activesEvents` WHERE `active_id` = $id AND `event_id` = $ev_id";
	if ( $result = mysqli_query( $conn, $sql ) ) {
		$count = mysqli_num_rows( $result );
		if ( $count > 0 ) {
			return 1;
		} else {
			$sql = "INSERT INTO `activesEvents` (`active_id`, `event_id`) VALUES ('$id','$ev_id')";
			mysqli_query( $conn, $sql );
			return 0;
		}
	}
	return 3;
}

function select_form( $id ) {
	$ret = "../forms/";
	switch ( $id ) {
		case 1:
		case 2:
		case 3:
			$ret .= "clinicForm.php";
			break;
		case 4:
		case 5:
			$ret .= "auditionForm.php";
			break;
		case 6:
			$ret .= "drumoffForm.php";
			break;
		case 7:
			$ret .= "videoForm.php";
			break;
		case 8:
			$ret .= "videoForm.php";
			break;
		case 9:
			$ret .= "april2017Form.php";
			break;
		default:
			$ret .= "noForm.php";
			break;
	}
	return $ret;
}

function instrument_switch( $inst ) {
	$ret = "N/A";
	switch ( $inst ) {
		case 1:
			$ret = "Trumpet";
			break;
		case 2:
			$ret = "Mellophone";
			break;
		case 4:
			$ret = "Baritone/Euphonium";
			break;
		case 8:
			$ret = "Tuba";
			break;
		case 16:
			$ret = "Snare";
			break;
		case 32:
			$ret = "Tenors";
			break;
		case 64:
			$ret = "Bass";
			break;
		case 128:
			$ret = "Cymbals";
			break;
		default:
			$ret = NULL;
			break;
	}
	return $ret;
}
?>