<?php
require('session.php');
require('../constants.php');

$id = false !== filter_var($_GET['id'], FILTER_VALIDATE_INT) ?
      $_GET['id'] : die("0");
$status = false !== filter_var($_GET['status'], FILTER_VALIDATE_INT) ?
	  intval($_GET['status']) : 0;
$adrs = @filter_var(trim($_GET['adrs']), FILTER_SANITIZE_STRING);
$desc = @filter_var(trim($_GET['desc']), FILTER_SANITIZE_STRING);

$statusObj = json_encode([
	"status" => $status,
	"url" => $adrs,
	"desc" => $desc,
]);

$q = "UPDATE pitew SET status='$statusObj' WHERE id=$id";
require(ABSPATH.'script/php/condb.php');
if($query) echo "1";
else echo "0";
?>
