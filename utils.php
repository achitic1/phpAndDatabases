<?php

	function getThreadId( $mysqli, $parentId ) {
		$currParentId = $parentId;
		$threadId = $parentId;
		$isNotNull = true;

		$result = $mysqli->query( "select * from achitic_post where id = $currParentId" );
		
		if( $result->num_rows === 0 ) {
			$isNotNull = false;
		}

		while( $isNotNull ) {
			$row = $result->fetch_assoc();
			$currParentId = $row['parentId'];

			if( $currParentId === NULL ) {
				$isNotNull = false;
			} else {
				$threadId = $currParentId;
				$result = $mysqli->query( "select * from achitic_post where id = $currParentId" );
			}
		}

		return $threadId;
	}
?>
