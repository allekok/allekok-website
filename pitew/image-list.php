<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title =
    _TITLE .
    " &raquo; پتەوکردنی ئاڵەکۆک &raquo; ناردنی وێنەی شاعیران &raquo; وێنەکان";
$desc = "ئەو وێنانەی کە بۆتان ناردوویین";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

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
     .imglist{width:35%;display:inline-block;
	 vertical-align:top;padding:1em .5em;
	 font-size:.55em}
     .imglist:nth-child(3n-1){border-left:1px solid #eee;
	 border-right:1px solid #eee;width:45%}
     .imglist:nth-child(3n){width:20%}
    </style>
    <div>
	<section class='imglist back-eee'
	>یارمەتیدەر</section
		   ><section
			class='imglist back-eee'
		    >نێوی شاعیر</section
			       ><section
				    class='imglist back-eee'
				>وێنە</section>
	<?php
	$_list = make_list(ABSPATH."style/img/poets/new/");
	foreach($_list as $_l)
	{
            echo "<section class='imglist color-444'
>" . $_l['name'] . "</section><section class='imglist color-444'
>" . $_l['poet'] . "</section><section class='imglist color-444'
>" . "<a class='link' href='/style/img/poets/new/{$_l['filename']}'
>وێنە</a></section>";
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
