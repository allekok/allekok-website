<?php
/* 
 * Save comments into 'comments' table. 
 * Input: POST:(comment,address,name)
 * Output: JSON
 */
require_once('constants.php');
include(ABSPATH.'script/php/functions.php');

header('Content-type: application/json; Charset=UTF-8');
$null = json_encode(NULL);

$comment = isset($_POST['comment']) ?
	   trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING)) :
	   die($null);
if(empty($comment)) die($null);

$address = isset($_POST['address']) ?
	   filter_var($_POST['address'], FILTER_SANITIZE_STRING) :
	   die($null);
if(empty($address)) die($null);

$name = isset($_POST['name']) ?
	trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING)) :
	'';

$date = date("Y-m-d h:i:sa");

$_ = explode('/', $address);
$poet_id = explode(':', $_[0])[1];
$book_id = explode(':', $_[1])[1];
$poem_id = explode(':', $_[2])[1];

$db = 'index';
$tbl = 'tbl' . $poet_id . '_' . $book_id;
$q = "select id from $tbl where id=$poem_id";
require(ABSPATH.'script/php/condb.php');
if(!$query) die($null);

$q = "INSERT INTO comments(address, date, name, comment) VALUES('$address', '$date', '$name', '$comment')";
$query = mysqli_query($conn, $q);

if($query)
{    
    $date = num_convert($date, "en", "ckb");
    $date = str_replace(["am","pm"],
			[" بەیانی "," پاش‌نیوەڕۆ "],
			$date);
    
    if($name == '') $name = 'ناشناس';
    
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
