<?php 
if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');
require_once("script/php/functions.php");
header("Content-type: text/plain; charset=UTF-8");

include(ABSPATH . "script/php/stats.php");
echo "شاعیر:";
echo $aths_num;
echo "\tکتێب:";
echo $bks_num;
echo "\tشێعر:";
echo $hons_num;

echo "\n\n*نووسینی شێعر*\n";

$db = "index";
$q = "select * from pitew where status LIKE '{\"status\":0%' order by id DESC";

require("script/php/condb.php");

if(mysqli_num_rows($query)>0) {
while($res = mysqli_fetch_assoc($query)) {
if($res['poem-name'] === "")    $res['poem-name'] = "شێعر";
echo "• {$res['contributor']} › {$res['poet']} › {$res['book']} › {$res['poem-name']}\n";
}
} else {
echo "•\n";
}
echo "\n*ناردنی وێنەی شاعیران*\n";
$_list = make_list(ABSPATH."style/img/poets/new/");
$a = 0;
if(! empty($_list)) {
foreach($_list as $_l) {
if($a === 2)    break 1;
echo "• " . $_l['name'] . " › " . $_l['poet'] . "\n";
$a++;
}
} else {
echo "•\n";
}

function make_list($_dir) {
if(! is_dir($_dir) )
return 0;

$d = opendir($_dir);
$_list = array();

while( false !== ($entry = readdir($d))) {
if(_unlist($entry)) {
$uri = "/style/img/poets/new/".$entry;
$entry = str_replace([".jpeg",".jpg",".png"], "", $entry);
$entry = explode("_", $entry);
$entry["poet"] = $entry[0];
$entry["name"] = $entry[1];
$entry["uri"] = $uri;
array_unshift($entry, filemtime("/home/allekokc/public_html" . $uri));
$_list[] = $entry;
}
}

if(rsort($_list))  return $_list;
}

function _unlist($v) {
$_Vs = array(".", "..");
if(! in_array($v, $_Vs) ) return $v;
}
echo "\n*نووسینی زانیاری سەبارەت بە شاعیران*\n";

$_list = make_list2(ABSPATH."pitew/res/");
$a = 0;
if(!empty($_list)) {
foreach($_list as $_l) {
if($a === 2)    break 1;
echo "• " . $_l['poet'] . " › " .  $_l['name'] . "\n";
$a++;
}
} else {
echo "•\n";
}

function make_list2($_dir) {
if(! is_dir($_dir) )
return 0;

$d = opendir($_dir);
$_list = array();

while( false !== ($entry = readdir($d))) {
if(_unlist($entry)) {
$uri = "/pitew/res/".$entry;
$entry = str_replace([".txt"], "", $entry);
$entry = explode("_", $entry);
$entry["poet"] = $entry[0];
$entry["name"] = $entry[1];
$entry["uri"] = $uri;
array_unshift($entry, filemtime("/home/allekokc/public_html" . $uri));
$_list[] = $entry;
}
}

if(rsort($_list))  return $_list;
}
echo "\n*بیر و ڕای شێعرەکان*\n";

$q = "select * from `comments` where `read`=0 order by `id` DESC";

$query = mysqli_query($conn, $q);

if(mysqli_num_rows($query)>0) {
while($res = mysqli_fetch_assoc($query)) {
if($res['name'] === "")    $res['name'] = "ناشناس";
echo "• {$res['name']}\n";
}
} else {
echo "•\n";
}

mysqli_close($conn);

// about.php
echo "\n*about.php*\n";
echo filter_var(file_get_contents("https://allekok.com/about/about-comments.php?num=1"), FILTER_SANITIZE_STRING) . "\n";

// allekok-desktop
echo "\n*allekok-desktop*\n";
echo file_get_contents(ABSPATH . "desktop/QA.txt") . "\n";

// allekok-mobile
echo "\n*allekok-mobile*\n";
echo file_get_contents(ABSPATH . "mobile/QA.txt") . "\n";

// pitew
echo "\n*پتەوکردنی ئاڵەکۆک*\n";
echo file_get_contents(ABSPATH . "pitew/QA.txt") . "\n";

// dev/tools
echo "\n*dev*\n";
echo file_get_contents(ABSPATH . "dev/tools/QA.txt") . "\n";

// manual
echo "\n*manual*\n";
echo file_get_contents(ABSPATH . "manual/QA.txt") . "\n";
?>
