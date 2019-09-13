<?php
/*
 * Input: REQUEST:(poet,book)
 * Output: JSON
 */
require_once('../../script/php/constants.php');
require(ABSPATH . 'script/php/functions.php');

header('Content-type:application/json; charset=UTF-8');
$null = json_encode(null);

$_pt = isset($_REQUEST['poet']) ?
       filter_var($_REQUEST['poet'], FILTER_SANITIZE_STRING) :
       die($null);
if(empty($_pt)) die($null);
$_bk = isset($_REQUEST['book']) ?
       filter_var($_REQUEST['book'], FILTER_SANITIZE_STRING) :
       die($null);
if(empty($_bk)) die($null);

$db = 'index';
$where = filter_var($_pt, FILTER_VALIDATE_INT) ?
	 "id=$_pt" :
	 "takh='$_pt' or profname='$_pt' or name='$_pt'";
$q = "SELECT * FROM auth WHERE $where";
require(ABSPATH . 'script/php/condb.php');
if(!$query) die($null);
$poet = mysqli_fetch_assoc($query);

$poet['bks'] = explode(',', $poet['bks']);
$poet['bksdesc'] = explode(',', $poet['bksdesc']);

if(!filter_var($_bk, FILTER_VALIDATE_INT))
{
    $_bk = array_search($_bk, $poet['bks']);
    if($_bk === false) die($null);
    $_bk++;
}
elseif($_bk > count($poet['bks']))
    die($null);

$_tbl = "tbl{$poet['id']}_{$_bk}";    
$q = "SELECT name FROM `$_tbl` ORDER BY id";
$query = mysqli_query($conn, $q);
if(!$query) die($null);

$pms_num = mysqli_num_rows($query);
$poems = [];
while($_ = mysqli_fetch_assoc($query))
    $poems[] = $_['name'];

$res = [
    'poetID' => intval($poet['id']),
    'poet' => $poet['takh'],
    'book' => $poet['bks'][$_bk-1],
    'bookID' => intval($_bk),
    'desc' => @$poet['bksdesc'][$_bk-1],
    'poems-num' => $pms_num,
    'poems' => $poems,
];

mysqli_close($conn);

echo json_encode($res);
?>
