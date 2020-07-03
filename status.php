<?php
require_once("script/php/constants.php");
require_once(ABSPATH."script/php/functions.php");

header("Content-type:text/plain; charset=UTF-8");

/* Statistics */
include(ABSPATH."script/php/stats.php");
echo "شاعیر:";
echo $aths_num;
echo "\tکتێب:";
echo $bks_num;
echo "\tشێعر:";
echo $hons_num;

/* New-Poems */
echo "\n\n/نووسینی شێعر/\n";
$q = "select * from pitew where status LIKE '{\"status\":0%' order by id DESC";
require(ABSPATH."script/php/condb.php");
if($query and (mysqli_num_rows($query) > 0))
{
	while($res = mysqli_fetch_assoc($query))
	{
		$res['poem-name'] = $res['poem-name'] ? $res['poem-name'] : "شێعر";
		echo "- {$res['contributor']} :: {$res['poet']} › {$res['book']} › {$res['poem-name']}\n";
	}
}
else
	echo "+•+\n";

/* New-Images */
echo "\n/ناردنی وێنەی شاعیران/\n";
$_list = make_list(ABSPATH."style/img/poets/new/");
foreach($_list as $i=>$_l)
{
	if($i == 2) break;
	echo "- {$_l['name']} › {$_l['poet']}\n";
}
if(!$_list)
	echo "+•+\n";

/* New-Poet-Descs */
echo "\n/نووسینی زانیاری سەبارەت بە شاعیران/\n";
$_list = make_list(ABSPATH."pitew/res/");
foreach($_list as $i=>$_l)
{
	if($i == 2)	break;
	echo "- {$_l['poet']} › {$_l['name']}\n";
}
if(!$_list)
	echo "+•+\n";

/* New-Comments */
echo "\n/بیر و ڕای شێعرەکان/\n";
$q = "select * from `comments` where `read`=0 order by `id` DESC";
$query = mysqli_query($conn, $q);
if($query and (mysqli_num_rows($query) > 0))
{
	while($res = mysqli_fetch_assoc($query))
	{
		$res['name'] = $res['name'] ? $res['name'] : "ناشناس";
		echo "- {$res['name']} › "._SITE."{$res['address']}\n";
	}
}
else
	echo "+•+\n";

mysqli_close($conn);

/* about */
echo "\n/ئاڵەکۆک؟/\n";
echo filter_var(
	str_replace("<i class='h'>", "\t",
		    file_get_contents(
			    _SITE . 'about/about-comments.php?num=1')),
	FILTER_SANITIZE_STRING) . "\n";

/* pitew */
echo "\n/پتەوکردنی ئاڵەکۆک/\n";
echo last(ABSPATH . "pitew/QA.txt") . "\n";

/* allekok-desktop */
echo "\n/دابەزاندنی بەرنامەی ئاڵەکۆک/\n";
echo last(ABSPATH . "desktop/QA.txt") . "\n";

/* dev/tools */
echo "\n/کۆدەکانی ئاڵەکۆک/\n";
echo last(ABSPATH . "dev/tools/QA.txt") . "\n";

/* CONTRIBUTING */
echo "\n/بەشداربوون لە نووسینی کۆدەکانی ئاڵەکۆک/\n";
echo last(ABSPATH . "dev/tools/CONTRIBUTING/QA.txt") . "\n";

/* Tools */
function make_list($_dir)
{
	if(!is_dir($_dir)) return [];
	$d = opendir($_dir);
	$not = [".","..","README.md"];
	$_list = [];
	while(false !== ($entry = readdir($d)))
	{
		if(in_array($entry,$not)) continue;
		$uri = "$_dir/$entry";
		$entry = str_replace([".jpeg",".jpg",".png",".txt"], "", $entry);
		$entry = explode("_", $entry);
		$entry["poet"] = $entry[0];
		$entry["name"] = $entry[1];
		array_unshift($entry, filemtime($uri));
		$_list[] = $entry;
	}
	@closedir($_dir);
	rsort($_list);
	return $_list;
}

function last ($path, $n=1)
{
	/* Get 'n' items from the tail of a 'QA.txt' */
	if(! file_exists($path))
		return '+•+';
	
	$file = file_get_contents($path);
	$file = explode("\nend\n", $file);
	$file = array_reverse($file);
	$return = '';
	
	foreach($file as $item)
	{
		if($n == 0) break;
		$item = trim($item);
		if(!$item) continue;
		$return .= "- $item\n";
		$n--;
	}
	$return = trim($return);
	if($return)
		return $return;
	else
		return '+•+';
}
?>
