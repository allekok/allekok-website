<?php
require_once("session.php");

$id = filter_var($_GET["id"], FILTER_VALIDATE_INT) !== false ?
      $_GET["id"] :
      die();
$block = 1;
$read = 1;

$q = "SELECT blocked FROM comments WHERE id={$id}";
require_once("../condb.php");
if($query and mysqli_fetch_assoc($query)["blocked"]) {
	$block = 0;
	$read = 0;
}

$q = "UPDATE `comments` " .
     "SET `blocked`={$block}, `read`={$read} " .
     "WHERE `id`={$id}";
if(mysqli_query($conn, $q))
	echo 1;

mysqli_close($conn);
?>
