<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title =
    _TITLE .
    " &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo; ناردنی وێنەی شاعیران &rsaquo; وێنەکان";
$desc = "ئەو وێنانەی کە بۆتان ناردوویین";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');

$name = isset($_GET['name']) ?
	filter_var($_GET['name'],FILTER_SANITIZE_STRING) :
	"";
$poet = isset($_GET['poet']) ?
	filter_var($_GET['poet'],FILTER_SANITIZE_STRING) :
	"";
?>
<div id="poets">  
    <div id='adrs'>
	<a href="first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i> &rsaquo; </i>
	<a href="poet-image.php">
	    <i style='vertical-align:middle;'
	       class='material-icons'>image</i>
	    ناردنی وێنەی شاعیران
	</a>
	<i> &rsaquo; </i>
	<div id="current-location">
	    وێنەکان
	</div>
    </div>
    <style>
     .imglist-con{display:flex;text-align:right}
     .imglist{vertical-align:top;padding:.2em 1em;
	 font-size:.55em;width:100%}
    </style>
    <div>
	<div class="imglist-con">
	    <section class='imglist color-blue'
	    >یارمەتیدەر</section>
	    <section class='imglist color-blue'
	    >نێوی شاعیر</section>
	    <section class='imglist color-blue'
	    >وێنە</section>
	</div>
	<?php
	$_list = make_list(ABSPATH."style/img/poets/new/");
	foreach($_list as $_l)
	{
            echo "<div class='imglist-con'><section 
class='imglist'
>" . $_l['name'] . "</section><section class='imglist'
>" . $_l['poet'] . "</section><section class='imglist'
>" . "<a class='link' href='/style/img/poets/new/{$_l['filename']}'
>وێنە</a></section></div>";
	}
	
	function make_list($path)
	{
	    global $name,$poet;
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
	    }
	    rsort($list);
	    return $list;
	}
	?>
    </div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
