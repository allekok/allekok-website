<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");


$_name1 = isset($_GET['name']) ?
	  filter_var($_GET['name'],FILTER_SANITIZE_STRING) : '';
// number of poems
$n = (@filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE) ?
     $_GET['n'] : 20;

$title = $_name1 ?
	 _TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo; نووسینی شێعر &rsaquo; شێعرەکانی \"$_name1\"" :
	 _TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo; نووسینی شێعر &rsaquo; شێعرەکان";
$desc = "ئەو شێعرانەی کە نووسیوتانە";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<style>
 .tmi-news
 {
     padding:0 .6em;
     font-size:1.1em;
 }
 .pmlist-container{border-bottom:1px solid}
 .pmlist-container section{vertical-align:top;padding:.2em 1em;font-size:.55em;text-align:right}
</style>
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
    <?php
    $db = 'index';
    $q = $_name1 ?
	 "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status`!='{\"status\":-2,\"url\":\"\",\"desc\":\"\"}' AND `contributor`='$_name1' ORDER BY `id` DESC" :
	 "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status`!='{\"status\":-2,\"url\":\"\",\"desc\":\"\"}' ORDER BY `id` DESC";
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
    <div class="tools-menu" style="font-size:.6em;padding-right:2em;margin-bottom:1em">
	<div style="display:flex;font-size:1.15em">
	    <div style="padding-left:1em">
		ئەژمار:
	    </div>
	    <div>
		<?php 
		function print_tools_menu ($all, $sel)
		{
		    global $_name1;
		    foreach($all as $o)
		    {
			$_ = num_convert($o, 'en', 'ckb');
			
			if($o == $sel)
			    echo "<span class='color-blue tmi-news'>{$_}</span>";
			elseif($sel == -1 and $_ == 'هەموو')
			    echo "<span class='color-blue tmi-news'>هەموو</span>";
			else
			{
			    if($o == 'هەموو') $o = -1;
			    echo "<a href='?name={$_name1}&n=$o' class='tmi-news'>{$_}</a>";
			}
		    }
		}

		print_tools_menu(['70','35','20','هەموو'], $n);
		?>
	    </div>
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
	if($n-- == 0) break;
        $_l['status'] = json_decode($_l['status'], true);
        if($_l['poem-name'] == "")
	    $_l['poem-name'] = "شێعر";
        if($_l["contributor"] == "")
	    $_l["contributor"] = "ناشناس";

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
	><section><a href='/{$_l['status']['url']}'
	>{$_l['poet']} &rsaquo; {$_l['poem-name']}</a>";

	if($_l['status']['status'] === -1)
	{
	    echo "<br><i class='color-blue'>هۆکار</i>: " . $_l['status']['desc'];
	}
	echo "</section></div>";
    }
    
    mysqli_close($conn);
    ?>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
