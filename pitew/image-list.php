<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; ناردنی وێنەی شاعیران &raquo; وێنەکان";
$desc = "ئەو وێنانەی کە بۆتان ناردوویین";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');

?>

<div id="poets">
    
    <div id='adrs'>
	<a href="first.php">
	    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<a href="poet-image.php">
	    <i style='vertical-align:middle;' class='material-icons'>image</i>
	    ناردنی وێنەی شاعیران
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<div id="current-location">
	    وێنەکان
	</div>

    </div>
    <div>
	<section class='imglist' style='background:#eee'>یارمەتیدەر</section><section style='background:#eee' class='imglist'>نێوی شاعیر</section><section style='background:#eee' class='imglist'>وێنە</section>
	
	<?php
	
	$_list = make_list(ABSPATH."style/img/poets/new/");
	foreach($_list as $_l) {
            echo "<section class='imglist'>" . $_l['name'] . "</section><section class='imglist'>" . $_l['poet'] . "</section><section class='imglist'>" . "<a class='link' href='/style/img/poets/new/{$_l['filename']}'>وێنە</a></section>";
	}
	
	function make_list($path) {
	    $not = [".",".."];
	    $d = opendir($path);
	    $list = [];

	    while( false !== ($e_name = readdir($d)) ) {
		if(in_array($e_name , $not)) continue;

		$exp_e_name = explode("_",
				      str_replace([".jpeg",".jpg",".png"],
						  "",$e_name));
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
