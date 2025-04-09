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
	$postTable = "";

	$sqlGetUsers = "select * from achitic_user";

	$userResult = $mysqli->query( $sqlGetUsers );

	while( $row = $userResult->fetch_assoc() ) {
		$userRow = "<tr><td>".$row['email']."</td><td>".$row['age']."</td><td>".$row['state']."</td></tr>";
		$userTable .= $userRow;
		$userTable .= "\n";
	}

	
	$sqlGetPosts = "select * from achitic_post";
	echo "$sqlGetPosts";

	$postResult = $mysqli->query( $sqlGetPosts );

	while( $row = $postResult->fetch_assoc() ) {
		$postRow = "<tr><td>".$row['id']."</td><td>".$row['body']."</td><td>".$row['likes']."</td><td>".$row['email']."</td><td>".$row['parentId']."</td><td>".$row['datePosted']."</td><td>".$row['threadId']."</td></tr>\n";
		$postTable = $postTable.$postRow;
	}
	
	include( "selectAll.html" );
	
?>
