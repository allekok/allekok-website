<?php
require('session.php');
require('../constants.php');

$id = false !== filter_var($_GET['id'], FILTER_VALIDATE_INT) ?
      $_GET['id'] : die();

$db = 'index';
$q = 'SELECT * FROM pitew WHERE id=$id';
require(ABSPATH.'script/php/condb.php');
if(!$query) die();

$row = mysqli_fetch_assoc($conn, $query);

header("Content-type:application/json; charset=utf-8");
echo json_encode(
    [
	'contributor'=>$row['contributor'],
	'poemName'=>$row['poem-name'],
	'poem'=>$row['poem'],
    ]);
?>
