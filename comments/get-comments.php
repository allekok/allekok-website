<?php
/*
 * Print {n} comments from 'comments' table.
 * Input: GET[n, from]
 * Output: JSON
 */
require_once("../script/php/constants.php");
require_once("../script/php/functions.php");

header("Content-Type: application/json; Charset=UTF-8");

$n = isset($_GET["n"]) ? intval($_GET["n"]) : 20;
$from = isset($_GET["from"]) ? intval($_GET["from"]) : 0;

$LIMIT = $n == -1 ? "" : "LIMIT $from, $n";
$q = "SELECT * FROM comments WHERE blocked=0 ORDER BY id DESC $LIMIT";
require_once("../script/php/condb.php");
if(!$query)
	die(json_encode(["err" => 1]));

$comms = [];

while($res = mysqli_fetch_assoc($query)) {
	$res["pt"] = substr($res["address"],
			    5,
			    strpos($res["address"], "/") - 5);
	unset($res["read"]);
	unset($res["blocked"]);
	$comms[] = $res;
}

foreach($comms as $key => $comm) {
	$_adrs = explode("/", $comm["address"]);
	$_adrs_len = count($_adrs);
	for($i = 0; $i < $_adrs_len; $i++)
		$_adrs[$i] = explode(":", $_adrs[$i]);
	
	$q = "SELECT takh FROM auth WHERE id={$_adrs[0][1]}";
	$query = mysqli_query($conn, $q);
	$comm["ptn"] = @mysqli_fetch_assoc($query)["takh"];
	
	$tbl = "tbl{$_adrs[0][1]}_{$_adrs[1][1]}";
	$q = "SELECT name FROM {$tbl} WHERE id={$_adrs[2][1]}";
	$query = mysqli_query($conn, $q);
	$comm["pmn"] = @mysqli_fetch_assoc($query)["name"];
	
	$comms[$key] = $comm;
}

mysqli_close($conn);

echo json_encode($comms);
?>
