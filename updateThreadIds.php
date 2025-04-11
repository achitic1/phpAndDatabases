<?php
	include ( "Constants.php" );

	$user = Constants::USER;
	$password = Constants::PASSWORD;
	$server = "localhost";
	$db = "cmsc436s23_424class";

	$mysqli = new mysqli( $server, $user, $password, $db );

	$sqlOne = "update achitic_post set threadId = 1 where id = 1";
	$sqlTwo = "update achitic_post set threadId = 2 where id = 2";
	$sqlThree = "update achitic_post set threadId = 3 where id = 3";
	$sqlFour = "update achitic_post set threadId = 4 where id in (4, 5)";
	$sqlFive = "update achitic_post set threadId = 6 where id in (6, 7, 8, 9, 10, 11)";

	$mysqli->query( $sqlOne );
	$mysqli->query( $sqlTwo );
	$mysqli->query( $sqlThree );
	$mysqli->query( $sqlFour );
	$mysqli->query( $sqlFive );
?>
