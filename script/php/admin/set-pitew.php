<?php
require_once("session.php");

$id = filter_var($_GET["id"], FILTER_VALIDATE_INT) !== false ?
      $_GET["id"] :
      die("0");
$status = filter_var($_GET["status"], FILTER_VALIDATE_INT) !== false ?
	  intval($_GET["status"]) :
	  0;
$adrs = @filter_var(trim($_GET["adrs"]), FILTER_SANITIZE_STRING);
$desc = @filter_var(trim($_GET["desc"]), FILTER_SANITIZE_STRING);

$statusObj = json_encode([
	"status" => $status,
	"url" => $adrs,
	"desc" => $desc
]);

$q = "UPDATE pitew SET status='$statusObj' WHERE id=$id";
require_once("../condb.php");
echo $query ? "1" : "0";
?>
