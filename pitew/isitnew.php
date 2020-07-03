<?php
/*
 * Input: GET:(poet)
 * Output: JSON:([new,id,img])
 */
require_once('../script/php/constants.php');

$new = 1;
$id = 0;
$img = 0;

if( isset($_GET['poet']) )
{
	$_poet = trim(filter_var($_GET['poet'], FILTER_SANITIZE_STRING));
	
	$q = "select id from auth where 
takh='$_poet' or profname='$_poet'";
	require(ABSPATH.'script/php/condb.php');
	if($query)
	{
		$res = mysqli_fetch_assoc($query);
		$id = $res['id'];
		$new = 0;
	}
	mysqli_close($conn);
}
else
	$new=0;

if(file_exists(ABSPATH."style/img/poets/profile/profile_{$id}.jpg"))
	$img = $id;

$_res = [
	'new' => $new,
	'id' => $id,
	'img' => $img,
];

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($_res);
?>
