<?php 
	include( "Constants.php" );
	$user = Constants::USER;
	$password = Constants::PASSWORD;
	$server = "localhost";
	$db = "cmsc436s23_424class";

	$mysqli = new mysqli($server, $user, $password, $db);

	$mysqli->query( "update achitic_post set threadId = null" );
?>
