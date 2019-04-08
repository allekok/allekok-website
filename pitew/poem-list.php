<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");


if(! empty($_GET['name']) ) $_name1 = filter_var($_GET['name'], FILTER_SANITIZE_STRING);

// //////////

$title = $_name1 ? _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی شێعر &raquo; شێعرەکانی \"$_name1\"" :  _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی شێعر &raquo; شێعرەکان";
$desc = "ئەو شێعرانەی کە نووسیوتانە";
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
	<a href="index.php">
	    <i style='vertical-align:middle;' class='material-icons'>note_add</i>
	    نووسینی شێعر
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<div id="current-location">
	    <i style='vertical-align:middle;' class='material-icons'></i>
	    شێعرەکان
	</div>

    </div>
    <style>
     .pmlist{display:inline-block;vertical-align:top;color:#444;padding:1em .5em;font-size:.55em}
     .pmlist:nth-child(odd){width:30%}
     .pmlist:nth-child(even){text-align:right;width:70%;border-right:1px solid #eee}
    </style>
    
    <?php
    $db = 'index';
    $q = $_name1 ? "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' and `contributor`='{$_name1}' ORDER BY `id` DESC" : "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' ORDER BY `id` DESC";
    include(ABSPATH . "script/php/condb.php");
    if(!$query) die();
    $_pmnum = num_convert(mysqli_num_rows($query), "en", "ckb");
    ?>
    <div style="color:#555; font-size:0.6em;margin:1em 0 0">
        ژمارەی شێعرەکان<?php
		       if($_name1) {
			   echo "ی \"$_name1\"";
		       }
		       echo " &rsaquo; <span style='letter-spacing:1.5px;'>". $_pmnum . "</span>";
		       ?>
    </div>
    <div style='text-align:right;margin:.3em 0'>
        <?php if($_name1) { ?>
            <a class='button' href="/pitew/poem-list.php">
		تەواوی ئەو شێعرانەی نووسراون
            </a>
        <?php } ?>
    </div>
    <section class='pmlist' style='background:#eee'>یارمەتیدەر</section><section style='background:#eee;text-align:center' class='pmlist'>شێعر</section>

    <?php
    if(! mysqli_num_rows($query))   echo "<span style=\"color:#999;font-size:1em;display:block\">•</span>";

    while($_l = mysqli_fetch_assoc($query)) {
        $_l['status'] = json_decode($_l['status'], true);
        if($_l['poem-name'] === "") $_l['poem-name'] = "شێعر";
        if($_l["contributor"] === "")   $_l["contributor"] = "ناشناس";
        
        echo "<section class='pmlist'>{$_l['contributor']}</section><section class='pmlist'><a class='link' href='/{$_l['status']['url']}'><span style='color:#666;'>{$_l['poet']}</span> &rsaquo; {$_l['poem-name']}</a></section>";
    }
    mysqli_close($conn);
    ?>
</div>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
