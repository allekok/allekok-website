<?php
require_once("../script/php/constants.php");
require_once(ABSPATH . "script/php/functions.php");

$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET["n"] : 10;

$base = "https://github.com/allekok/diwan/raw/master/";
$list_uri = "pdfs.txt";
$list = file_exists($list_uri) ?
	explode("\n\n",
		file_get_contents($list_uri)) : [];
$list[] = "سافی هیرانی - دیوان ۲\t\t234.1MB\t\tناردن: کەماڵ ڕەحمانی";
sort($list);

for($i = 0; $i<count($list); $i++)
{
	if($n-- == 0) break;
	$num = num_convert($i+1, "en", "ckb");
	$list[$i] = explode("\t\t", $list[$i]);
	$name = str_replace(".pdf", "", strtolower($list[$i][0]));
	if($name == "سافی هیرانی - دیوان ۲")
	{
		echo "<div class='eee'><span>$num.</span> <a target='_blank' href='https://archive.org/download/safi_hirani_diwan/%D8%B3%D8%A7%D9%81%DB%8C%20%D9%87%DB%8C%D8%B1%D8%A7%D9%86%DB%8C%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86.pdf'>$name</a> <i class='eee-nfo'>({$list[$i][1]} ,PDF)</i>";
		echo "<i class='material-icons pdfs-roll'>info_outline</i>";
		$list[$i][2] = str_replace("\n", "<br>", $list[$i][2]);
		echo "<div class='eee-desc'>{$list[$i][2]}</div></div>";
	}
	else
	{
		echo "<div class='eee'><span>$num.</span> <a target='_blank' href='$base{$list[$i][0]}'>$name</a> <i class='eee-nfo'>({$list[$i][1]} ,PDF)</i>";
		if(@$list[$i][2])
		{
			echo "<i class='material-icons pdfs-roll'>info_outline</i>";
			$list[$i][2] = str_replace("\n", "<br>", $list[$i][2]);
			echo "<div class='eee-desc'>{$list[$i][2]}</div>";
		}
		echo "</div>";
	}
}
?>
