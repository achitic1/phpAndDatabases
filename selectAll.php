<?php
	include( "Constants.php" );
	$password = Constants::PASSWORD;
	$user = Constants::USER;
	$server = "localhost";
	$database = "cmsc436s23_424class";
	$mysqli = new mysqli( $server, $user, $password, $database );

	if( $mysqli->connect_error )
		echo "Error Connecting\n";
	else 
		echo "Connecting successfully\n";

	// TO be populated with html for generating the tables
	$userTable = "";
	$postTable = "<";

	$sql = "select * from achitic_user";

	$result = $mysqli->query( $sql );

	while( $row = $result->fetch_assoc() ) {
		$userRow = "<tr><td>".$row['email']."</td><td>".$row['age']."</td><td>".$row['state']."</td></tr>\n";
		$userTable = $userTable.$userRow;
	}

	include( "selectAll.html" );

?>
