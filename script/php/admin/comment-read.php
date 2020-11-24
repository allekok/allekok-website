<?php
require('session.php');
if(! (filter_var($_GET['id'], FILTER_VALIDATE_INT) === false) ) {

	$read = 1;
	
	$id = $_GET['id'];

	$q = "SELECT `read` FROM comments WHERE id={$id}";
	
	require("../condb.php");

	if($query) {
		if(mysqli_fetch_assoc($query)["read"])
			$read = 0;
	}
	
	$q = "UPDATE `comments` SET `read`={$read} WHERE `id`={$id}";
	if($query = mysqli_query($conn, $q)) {
		echo 1;
	}
	
	mysqli_close($conn);
}
?>
