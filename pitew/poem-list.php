<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");


$_name1 = isset($_GET['name']) ?
	  filter_var($_GET['name'],FILTER_SANITIZE_STRING) : '';

$title = $_name1 ?
	 _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی شێعر &raquo; شێعرەکانی \"$_name1\"" :
	 _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی شێعر &raquo; شێعرەکان";
$desc = "ئەو شێعرانەی کە نووسیوتانە";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<div id="poets">
    <div id='adrs'>
	<a href="first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i> &rsaquo; </i>
	<a href="index.php">
	    <i class='material-icons'>note_add</i>
	    نووسینی شێعر
	</a>
	<i> &rsaquo; </i>
	<div id="current-location">
	    <i class='material-icons'></i>
	    شێعرەکان
	</div>
    </div>
    
    <style>
     .pmlist-container{display:flex}
     .pmlist-container section{vertical-align:top;padding:.2em 1em;font-size:.55em;text-align:right}
    </style>
    
    <?php
    $db = 'index';
    $q = $_name1 ?
	 "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' and `contributor`='$_name1' ORDER BY `id` DESC" :
	 "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' ORDER BY `id` DESC";
    include(ABSPATH . "script/php/condb.php");
    if(!$query) die();
    $_pmnum = num_convert(mysqli_num_rows($query), "en", "ckb");
    ?>
    <div style="display:flex;font-size:.55em;
		margin:1em 0">
	<div style="width:100%;text-align:right;
		    padding:0 .5em">
        ئەژماری شێعرەکان<?php
		       if($_name1)
			   echo "ی \"$_name1\"";
		       echo " : <span style='letter-spacing:1.5px'>". $_pmnum . "</span>";
		       ?>
    </div>
    <div style='width:100%;text-align:left;
		padding:0 .5em'>
        <?php if($_name1) { ?>
            <a href="/pitew/poem-list.php">
		تەواوی شێعرەکان &rsaquo;
            </a>
        <?php } ?>
    </div>
    </div>
    <div class="pmlist-container">
	<section style="width:100%"
	    class='color-blue'>یارمەتیدەر</section>
	<section style="width:100%"
	    class='color-blue'>شێعر</section>
    </div>
    
    <?php
    if(! $_pmnum)
	echo "<div style='font-size:1em'>•</div>";

    while($_l = mysqli_fetch_assoc($query))
    {
        $_l['status'] = json_decode($_l['status'], true);
        if($_l['poem-name'] == "")
	    $_l['poem-name'] = "شێعر";
        if($_l["contributor"] == "")
	    $_l["contributor"] = "ناشناس";
        
        echo "<div class='pmlist-container'><section>{$_l['contributor']}</section
><section><a href='/{$_l['status']['url']}'
>{$_l['poet']} &rsaquo; {$_l['poem-name']}</a></section></div>";
    }
    
    mysqli_close($conn);
    ?>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
