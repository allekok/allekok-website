<?php
/* 
 * Save comments into 'comments' table. 
 * Input: POST:(comment,address,name)
 * Output: JSON
 */
require_once('constants.php');
require_once(ABSPATH.'script/php/functions.php');
require_once(ABSPATH.'script/php/kurdish-calendar.php');

header('Content-type: application/json; Charset=UTF-8');
$null = json_encode(NULL);

$comment = @trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
if(!$comment) die($null);

$address = @trim(filter_var($_POST['address'], FILTER_SANITIZE_STRING));
if(!$address) die($null);

$name = @trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
if(!$name) $name = 'ناشناس';

$date = explode("-", date("m-d-Y"));
$date = calendarKurdishFromGregorian($date);
$date = "{$date[1]}؍{$date[0]}؍{$date[2]}";
$time = date("H:i:s");
$date = "$date - $time بەکاتی مەهاباد";
$date = num_convert($date, "en", "ckb");

$_ = explode('/', $address);
$poet_id = explode(':', $_[0])[1];
$book_id = explode(':', $_[1])[1];
$poem_id = explode(':', $_[2])[1];

$tbl = 'tbl' . $poet_id . '_' . $book_id;
$q = "select id from $tbl where id=$poem_id";
require(ABSPATH.'script/php/condb.php');
if(!$query) die($null);

$q = "INSERT INTO comments(address, date, name, comment) VALUES('$address', '$date', '$name', '$comment')";
$query = mysqli_query($conn, $q);

if($query) {    

	$res = [
		'message'=>'',
		'status'=>1,
		'name'=>$name,
		'comment'=>$comment,
		'date'=>$date,
	];
	
	echo json_encode($res);
}

mysqli_close($conn);
?>
