<?php
require_once("session.php");
require_once("../constants.php");

$id = filter_var($_GET["id"], FILTER_VALIDATE_INT) !== false ?
      $_GET["id"] :
      die();

$q = "SELECT * FROM pitew WHERE id=$id";
require_once("../condb.php");
if(!$query)
	die();

$row = mysqli_fetch_assoc($query);
$statusObj = json_decode($row["status"], true);

header("Content-type:application/json; charset=utf-8");
echo json_encode([
	"contributor" => $row["contributor"],
	"poet" => $row["poet"],
	"book" => $row["book"],
	"poemName" => $row["poem-name"],
	"poem" => $row["poem"],
	"status" => $statusObj["status"],
	"adrs" => $statusObj["url"],
	"desc" => $statusObj["desc"]]);
?>
