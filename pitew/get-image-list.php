<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/functions.php");

$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET["n"] : 10;
$name = isset($_GET['name']) ?
	filter_var($_GET['name'],FILTER_SANITIZE_STRING) :
	"";
$poet = isset($_GET['poet']) ?
	filter_var($_GET['poet'],FILTER_SANITIZE_STRING) :
	"";
$_list = make_list(ABSPATH."style/img/poets/new/");
foreach($_list as $_l)
{
    echo "<div class='imglist-con'><section 
class='imglist'
>" . $_l['name'] . "</section><section class='imglist'
>" . $_l['poet'] . "</section><section class='imglist'
>" . "<a class='link' href='" . _R . "style/img/poets/new/{$_l['filename']}'
target='_blank'>وێنە</a></section></div>";
}

function make_list($path)
{
    global $name,$poet,$n;
    $not = [".","..","README.md","list.txt"];
    $d = file_exists($path) ?
	 opendir($path) : die();
    $list = [];

    while( false !== ($e_name = readdir($d)) ) {
	if(in_array($e_name , $not)) continue;
	$exp_e_name = explode(
	    "_",str_replace(
		[".jpeg",".jpg",".png"],"",
		$e_name));
	if($poet and
	    $exp_e_name[0] != $poet)
	continue;
	if($name and
	    $exp_e_name[1] != $name)
	continue;
	$e = [
	    "filemtime"=>filemtime($path.$e_name),
	    "filename"=>$e_name,
	    "poet"=>$exp_e_name[0],
	    "name"=>$exp_e_name[1],
	];
	$list[] = $e;
	if(--$n == 0) break;
    }
    rsort($list);
    return $list;
}
?>
