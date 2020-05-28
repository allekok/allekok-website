<?php
require_once("../script/php/constants.php");
$_name1 = @trim(filter_var($_GET['name'],FILTER_SANITIZE_STRING));
// number of poems
$n = (@filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE) ?
     $_GET['n'] : 20;
$q = $_name1 ?
     "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status`!='{\"status\":-2,\"url\":\"\",\"desc\":\"\"}' AND `contributor`='$_name1' ORDER BY `id` DESC" :
     "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status`!='{\"status\":-2,\"url\":\"\",\"desc\":\"\"}' ORDER BY `id` DESC";
include(ABSPATH . "script/php/condb.php");
if(!$query) die();
$_pmnum = mysqli_num_rows($query);
if(! $_pmnum)
	echo "<div style='font-size:1em'>•</div>";

while($_l = mysqli_fetch_assoc($query))
{
	if($n-- == 0) break;
	$_l['status'] = json_decode($_l['status'], true);
	if($_l['poem-name'] == "")
		$_l['poem-name'] = "شێعر";
	
	echo "<div class='pmlist-container'><section>";
	if($_l['status']['status'] === 1)
	{
		echo "<i class='material-icons color-blue'>check</i> ";
	}
	elseif($_l['status']['status'] === 0)
	{
		echo "<i class='material-icons'>sync</i> ";
	}
	else
	{
		echo "<i class='material-icons color-red'>close</i> ";
	}
	echo "<a href='?name={$_l['contributor']}'>{$_l['contributor']}</a></section
	><section><a href='" . _R . "{$_l['status']['url']}'
	>{$_l['poet']} &rsaquo; {$_l['poem-name']}</a>";

	if($_l['status']['status'] === -1)
	{
		echo "<br><i class='color-blue'>هۆکار</i>: " . $_l['status']['desc'];
	}
	echo "</section></div>";
}

mysqli_close($conn);
?>
