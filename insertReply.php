<?php 
	include( "Constants.php" );
	$user = Constants::USER;
	$password = Constants::PASSWORD;
	$server = "localhost";
	$db = "cmsc436s23_424class";

	$mysqli = new mysqli($server, $user, $password, $db);
	
	$body = $mysqli->real_escape_string( $_POST['replyBody'] );
	$email = $mysqli->real_escape_string( $_POST['replyEmail'] );
	$parentId = $mysqli->real_escape_string( $_POST['replyParentId'] );

	// Input validation for the length of the arguments
	if( strlen($email) > 30 || strlen($body) > 200 ){
		echo "EMAIL OR BODY TOO LONG";
	}


	$result = $mysqli->query( "select * from achitic_post where id = $parentId" );

	if( $result->num_rows === 0 ) {
		echo "INVALID PARENT ID";
		return;
	}


	// Go through a sequence of parent ids until null is hit meaning it is the beginning of the thread
	$currParentId = $parentId;
	$threadId = $parentId;
	$isNotNull = true;
	$result = $mysqli->query( "select * from achitic_post where id = $currParentId" );
	
	while( $isNotNull ){
		$row = $result->fetch_assoc();
		$currParentId = $row['parentId'];
		
		if( $currParentId === NULL ) {
			$isNotNull = false;
		} else {
			$threadId = $currParentId;
			$result = $mysqli->query( "select * from achitic_post where id = $currParentId" );
		}
	}

	// Inserting the reply into the post table
	$sql = "insert into achitic_post (body, email, parentId, threadId) values (\"$body\", \"$email\", $parentId, $threadId)";
	$mysqli->query( $sql );
?>
