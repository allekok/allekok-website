<?php
/* Include Libraries */
require_once("script/php/constants.php");
require_once(ABSPATH."script/php/functions.php");

/* Sending HTTP headers */
header("Content-type:text/plain; charset=UTF-8");

/* Getting 'N: Number of Items' */
$N = @filter_var($_GET["n"], FILTER_VALIDATE_INT) ? $_GET["n"] : 5;

/* Statistics */
echo "ئەژمار:\n";

include_once(ABSPATH."script/php/stats.php");
echo "\tشاعیر:" . $aths_num;
echo "\tکتێب:" . $bks_num;
echo "\tشیعر:" . $hons_num;

/* New Poems */
echo "\n\nنووسینی شیعر:\n";
echo "["._SITE."pitew/poem-list.php]\n";

$q = "select * from pitew where status LIKE '{\"status\":0%' order by id DESC";
require(ABSPATH."script/php/condb.php");
if($query and mysqli_num_rows($query) > 0) {
	while($res = mysqli_fetch_assoc($query)) {
		$contrib = $res['contributor'];
		$pt = $res['poet'];
		$bk = $res['book'];
		$pm = $res['poem-name'] ? $res['poem-name'] : "شیعر";
		echo "\t- {$contrib} :: {$pt} › {$bk} › {$pm}\n";
	}
}
else
	echo "\t•\n";

/* New Comments */
echo "\nبیر و ڕای شیعرەکان:\n";
echo "["._SITE."comments/index.php]\n";

$q = "SELECT * FROM comments WHERE `read`=0 ORDER BY id DESC";
$query = mysqli_query($conn, $q);
if($query and mysqli_num_rows($query) > 0) {
	while($res = mysqli_fetch_assoc($query)) {
		$res['name'] = $res['name'] ? $res['name'] : "ناشناس";
		echo "\t- {$res['name']} › ["._SITE."{$res['address']}]\n";
	}
}
else
	echo "\t•\n";

/* Terminate MySQL Connection */
mysqli_close($conn);

/* New Images */
echo "\nناردنی وێنەی شاعیران:\n";
echo "["._SITE."pitew/image-list.php]\n";
print_new_images($N);

/* New Poet Descs */
echo "\nنووسینی زانیاری سەبارەت بە شاعیران:\n";
echo "["._SITE."pitew/poetdesc-list.php]\n";
print_new_poet_descs($N);

/* Pitew */
echo "\nپتەوکردنی ئاڵەکۆک:\n";
echo "["._SITE."pitew/first.php]\n";
echo last(ABSPATH . "pitew/QA.txt") . "\n";

/* Allekok Desktop */
echo "\nدابەزاندنی بەرنامەی ئاڵەکۆک:\n";
echo "["._SITE."desktop/index.php]\n";
echo last(ABSPATH . "desktop/QA.txt") . "\n";

/* Dev Tools */
echo "\nکۆدەکانی ئاڵەکۆک:\n";
echo "["._SITE."dev/tools/index.php]\n";
echo last(ABSPATH . "dev/tools/QA.txt") . "\n";

/* CONTRIBUTING */
echo "\nبەشداربوون لە نووسینی کۆدەکانی ئاڵەکۆک:\n";
echo "["._SITE."dev/tools/CONTRIBUTING/index.php]\n";
echo last(ABSPATH . "dev/tools/CONTRIBUTING/QA.txt") . "\n";

/* About */
echo "\nسەبارەت بە ئاڵەکۆک:\n";
echo "["._SITE."about/index.php]\n";
print_about_comments($N);

/* Functions */
function last ($path, $n = 5) {
	/* Get 'n' items from end of a 'QA.txt' file. */
	if(!file_exists($path))
		return "\t•";
	
	$file = file_get_contents($path);
	$file = explode("\nend\n", $file);
	$file = array_reverse($file);
	$return = "";
	
	foreach($file as $item) {
		if(!($item = trim($item)))
			continue;
		if($n-- == 0)
			break;
		$item = str_replace("\n", "\n\t", $item);
		$return .= "\t- $item\n\n";
	}

	$return = rtrim($return);
	return $return ? $return : "\t•";
}

function make_list($_dir) {
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
	closedir($d);
	rsort($_list);
	return $_list;
}

function print_new_images($n = 5) {
	$list = make_list(ABSPATH."style/img/poets/new/");
	if($list) {
		foreach($list as $i => $l) {
			if($i == $n) break;
			echo "\t- {$l['name']} › [شاعیر: {$l['poet']}]\n";
		}
	}
	else
		echo "\t•\n";
}

function print_new_poet_descs($n = 5) {
	$list = make_list(ABSPATH."pitew/res/");
	if($list) {
		foreach($list as $i => $l) {
			if($i == $n) break;
			echo "\t- {$l['poet']} › [شاعیر: {$l['name']}]\n";
		}
	}
	else
		echo "\t•\n";
}

function print_about_comments($n = 5) {
	$s = file_get_contents(_SITE."about/about-comments.php?num={$n}");
	if($s) {
		echo "\t";
		echo filter_var(str_replace(
			["<i class='h'>", "</i>"],
			["\n\t\t[", "]\n\n\t"],$s),
				FILTER_SANITIZE_STRING) . "\n";
	}
	else
		echo "\t•\n";
}
?>
