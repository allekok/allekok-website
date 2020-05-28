<?php
/*
 * Fetch comments from 'comments' table.
 * Input: GET:(address)
 * Output: JSON
 */
require_once('constants.php');
require_once(ABSPATH.'script/php/functions.php');

header("Content-Type: application/json; charset=UTF-8");

$address = @trim(filter_var($_GET['address'], FILTER_SANITIZE_STRING));
if(!$address) die(json_encode(['err'=>1]));

$q = "select date,name,comment from comments where address='$address' and blocked=0 order by id DESC";
include(ABSPATH.'script/php/condb.php');

if($query)
{
	$comms = [];
	while($res = mysqli_fetch_assoc($query))
		$comms[] = $res;
	
	echo json_encode($comms);
}

mysqli_close($conn);
?>
