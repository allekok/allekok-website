<?php
/*
 * This program will accept GET(uri) as input and
 * will increase its ranking in search database by 1
 * and at last will redirect to GET(uri).
 */
include_once("constants.php");

/* Input: GET(uri) */
$uri = @filter_var($_GET["uri"],FILTER_SANITIZE_STRING);
$address = explode("/", $uri);
if(count($address) != 3) die();
foreach($address as $i=>$part)
	$address[$i] = intval(explode(":",$part)[1]);
$poet_id = $address[0];
$book_id = $address[1];
$poem_id = $address[2];

/* Lookup poem */
$db = _SEARCH_DB;
$q = "SELECT Cipi FROM poems WHERE 
poet_id=$poet_id and 
book_id=$book_id and 
poem_id=$poem_id";
include(ABSPATH . "script/php/condb.php");
if(mysqli_num_rows($query) !== 1) die();

/* Update Cipi */
$res = mysqli_fetch_assoc($query);
$Cipi = $res["Cipi"] + 1;
$query = mysqli_query($conn, "UPDATE `poems` SET `Cipi`=$Cipi 
WHERE poet_id=$poet_id and book_id=$book_id and poem_id=$poem_id");
mysqli_close($conn);

/* Redirection */
redirect(_SITE . $uri);

/* Functions */
function redirect($url, $statusCode = 303) {
	header("Location: " . $url, true, $statusCode);
	die();
}
?>
