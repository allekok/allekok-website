<?php
/*
 * Input: GET:(poet)
 * Output: JSON:([new,id,img])
 */
require_once('../script/php/constants.php');
include(ABSPATH . 'script/php/functions.php');

header('Content-Type: application/json; charset=UTF-8');

$new = 1;
$_id = 0;
$img = 0;

if( isset($_GET['poet']) )
{
    $_poet = trim(filter_var($_GET['poet'], FILTER_SANITIZE_STRING));
    
    $db = 'index';
    $q = "select id, name, takh, profname from auth where takh='$_poet' or profname='$_poet'";
    require(ABSPATH.'script/php/condb.php');
    if($query)
    {
	$res = mysqli_fetch_assoc($query);
	$_id = $res['id'];
	$new = 0;
    }
    mysqli_close($conn);
}
else
    $new=0;

if(file_exists(ABSPATH."style/img/poets/profile/profile_{$_id}.jpg"))
    $img = $_id;

$_res = [
    'new' => $new,
    'id' => $_id,
    'img' => $img,
];

echo json_encode($_res);
?>
