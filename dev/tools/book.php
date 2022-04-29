<?php
/*
 * Input: REQUEST[poet, book]
 * Output: JSON
 */
require_once("../../script/php/functions.php");

header("Content-type:application/json; charset=UTF-8");

$null = json_encode(null);

$pt = isset($_REQUEST["poet"]) ?
       filter_var($_REQUEST["poet"], FILTER_SANITIZE_STRING) :
       die($null);
$bk = isset($_REQUEST["book"]) ?
       filter_var($_REQUEST["book"], FILTER_SANITIZE_STRING) :
       die($null);

if(empty($pt) or empty($bk))
	die($null);

$where = filter_var($pt, FILTER_VALIDATE_INT) ?
	 "id=$pt" :
	 "takh='$pt' or profname='$pt' or name='$pt'";
$q = "SELECT * FROM auth WHERE $where";
require_once("../../script/php/condb.php");
if(!$query)
	die($null);

$poet = mysqli_fetch_assoc($query);
$poet["bks"] = explode(",", $poet["bks"]);
$poet["bksdesc"] = explode(",", $poet["bksdesc"]);

if(!filter_var($bk, FILTER_VALIDATE_INT)) {
	$bk = array_search($bk, $poet["bks"]);
	if($bk === FALSE)
		die($null);
	$bk++;
}
elseif($bk > count($poet["bks"])) {
	die($null);
}

$bk_desc = isset($poet["bksdesc"][$bk - 1]) ? $poet["bksdesc"][$bk - 1] : "";

$_tbl = "tbl{$poet["id"]}_{$bk}";
$q = "SELECT name FROM `$_tbl` ORDER BY id";
$query = mysqli_query($conn, $q);
if(!$query)
	die($null);

$pms_num = mysqli_num_rows($query);
$poems = [];
while($pm = mysqli_fetch_assoc($query))
	$poems[] = $pm["name"];

mysqli_close($conn);

$res = [
	"poetID" => intval($poet["id"]),
	"poet" => $poet["takh"],
	"book" => $poet["bks"][$bk - 1],
	"bookID" => intval($bk),
	"desc" => $bk_desc,
	"poems-num" => $pms_num,
	"poems" => $poems,
];
echo json_encode($res);
?>
