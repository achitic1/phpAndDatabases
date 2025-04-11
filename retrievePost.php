<?php
	require_once( "utils.php" );
	include( "Constants.php" );
	$password = Constants::PASSWORD;
	$user = Constants::USER;
	$server = "localhost";
	$database = "cmsc436s23_424class";
	$mysqli = new mysqli( $server, $user, $password, $database );
	
	$postId = $mysqli->real_escape_string( $_GET['postId'] );

	// Retreive and validate the postId
	$sql = "select * from achitic_post where id = $postId";
	$result = $mysqli->query( $sql );

	if( $result->num_rows === 0 ){
		echo "INVALID POST ID";
		return;
	}

	// Use postId to get threadId and retrieve body, email, age, state, and datePosted for every post in the thread. 
	$threadId = getThreadId( $mysqli, $postId );

	$sql = "select id, body, achitic_user.email, age, state, datePosted from achitic_user, achitic_post where (achitic_user.email = achitic_post.email and achitic_post.threadId = $threadId) order by datePosted";

	$result = $mysqli->query( $sql );

	$threadTable = "<table><tr><th>Id</th><th>Body</th><th>Email</th><th>Age</th><th>State</th><th>Date Posted</th></tr>";

	while( $row = $result->fetch_assoc() ){
		$threadTable .= "<tr><td>".$row['id']."</td><td>".$row['body']."</td><td>".$row['echitic_user.email']."</td><td>".$row['age']."</td><td>".$row['state']."</td><td>".$row['datePosted']."</td></tr>";
		$threadTable .= "\n";	
	}

	$threadTable .= "</table>";

	include( "retrievePost.html" );

	
?>
