<?php
require('session.php');
if(! (filter_var($_GET['id'], FILTER_VALIDATE_INT) === false) ) {

	$block = 1;
	$read = 1;
	
	$id = $_GET['id'];

	$q = "SELECT blocked FROM comments WHERE id={$id}";
	
	require("../condb.php");

	if($query) {
		$blocked = mysqli_fetch_assoc($query)["blocked"];
		if($blocked) {
			$block = 0;
			$read = 0;
		}
	}

	$q = "UPDATE `comments` SET `blocked`={$block}, `read`={$read} WHERE `id`={$id}";
		
	if($query = mysqli_query($conn, $q)) {
		echo 1;
	}
	
	mysqli_close($conn);
}
?>
