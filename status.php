<?php
header("Content-type:text/plain; charset=UTF-8");
require_once("script/php/constants.php");
require_once(ABSPATH."script/php/functions.php");

/* Statistics */
include(ABSPATH."script/php/stats.php");
echo "شاعیر:";
echo $aths_num;
echo "\tکتێب:";
echo $bks_num;
echo "\tشێعر:";
echo $hons_num;

/* New-Poems */
echo "\n\n*نووسینی شێعر*\n";
$db = "index";
$q = "select * from pitew where status LIKE '{\"status\":0%' order by id DESC";
require(ABSPATH."script/php/condb.php");
if($query and (mysqli_num_rows($query) > 0))
{
    while($res = mysqli_fetch_assoc($query))
    {
	$res['poem-name'] = $res['poem-name'] ? $res['poem-name'] : "شێعر";
	echo "• {$res['contributor']}:: {$res['poet']} › {$res['book']} › {$res['poem-name']}\n";
    }
}
else
{
    echo "•\n";
}

/* New-Images */
echo "\n*ناردنی وێنەی شاعیران*\n";
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
	$entry = str_replace([".jpeg",".jpg",".png"], "", $entry);
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
$_list = make_list(ABSPATH."style/img/poets/new/");
foreach($_list as $i=>$_l)
{
    if($i == 2) break;
    echo "• {$_l['name']}:: {$_l['poet']}\n";
}
if(!$_list) echo "•\n";

/* New-Poet-Descs */
echo "\n*نووسینی زانیاری سەبارەت بە شاعیران*\n";
$_list = make_list(ABSPATH."pitew/res/");
foreach($_list as $i=>$_l)
{
    if($i == 2)	break;
    echo "• {$_l['poet']}:: {$_l['name']}\n";
}
if(!$_list) echo "•\n";

/* New-Comments */
echo "\n*بیر و ڕای شێعرەکان*\n";
$q = "select * from `comments` where `read`=0 order by `id` DESC";
$query = mysqli_query($conn, $q);
if($query and (mysqli_num_rows($query) > 0))
{
    while($res = mysqli_fetch_assoc($query))
    {
	$res['name'] = $res['name'] ? $res['name'] : "ناشناس";
	echo "• {$res['name']}\n";
    }
}
else
{
    echo "•\n";
}
mysqli_close($conn);

/* about.php */
echo "\n*about.php*\n";
echo filter_var(file_get_contents("https://allekok.com/about/about-comments.php?num=1"),
		FILTER_SANITIZE_STRING) . "\n";

/* allekok-desktop */
echo "\n*allekok-desktop*\n";
echo @file_get_contents(ABSPATH . "desktop/QA.txt") . "\n";

/* allekok-mobile */
echo "\n*allekok-mobile*\n";
echo @file_get_contents(ABSPATH . "mobile/QA.txt") . "\n";

/* pitew */
echo "\n*پتەوکردنی ئاڵەکۆک*\n";
echo @file_get_contents(ABSPATH . "pitew/QA.txt") . "\n";

/* dev/tools */
echo "\n*dev*\n";
echo @file_get_contents(ABSPATH . "dev/tools/QA.txt") . "\n";

/* manual */
echo "\n*manual*\n";
echo @file_get_contents(ABSPATH . "manual/QA.txt") . "\n";

/* CONTRIBUTING */
echo "\n*CONTRIBUTING*\n";
echo @file_get_contents(ABSPATH . "dev/tools/CONTRIBUTING/QA.txt") . "\n";
?>
