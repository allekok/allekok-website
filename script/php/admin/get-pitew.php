<?php
require('session.php');
require('../constants.php');

$id = false !== filter_var($_GET['id'], FILTER_VALIDATE_INT) ?
      $_GET['id'] : die();

$q = "SELECT * FROM pitew WHERE id=$id";
require(ABSPATH.'script/php/condb.php');
if(!$query) die();

$row = mysqli_fetch_assoc($query);
$statusObj = json_decode($row["status"], true);

header("Content-type:application/json; charset=utf-8");
echo json_encode([
	'contributor'=>$row['contributor'],
	'poet'=>$row['poet'],
	'book'=>$row['book'],
	'poemName'=>$row['poem-name'],
	'poem'=>$row['poem'],
	'status'=>$statusObj['status'],
	'adrs'=>$statusObj['url'],
	'desc'=>$statusObj['desc'],
]);
?>
