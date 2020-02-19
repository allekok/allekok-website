<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; تازەکان";
$desc = $title;
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
/* Number of poems */
$n = (@filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE) ?
     $_GET['n'] : 20;
?>
<style>
 .link-news {
     display:block;
     border-bottom:0;
     padding:0;margin:0
 }
 .tmi-news
 {
     padding:0 .6em;
     font-size:1.1em;
 }
</style>
<div id="poets" style="text-align:right">
    <h1 class="color-blue" style="font-size:1em;
	       text-align:right">
        <?php P("news"); ?>
    </h1>
    <div style="font-size:.6em;padding-right:2em">
	<div class="tools-menu">
	    <div style="display:flex;font-size:1.15em">
		<div style="padding-left:1em">
		    ئەژمار:
		</div>
		<div>
		    <?php 
		    function print_tools_menu ($all, $sel)
		    {
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
				echo "<a href='?n=$o' class='tmi-news'>{$_}</a>";
			    }
			}
		    }

		    print_tools_menu(['70','35','20','هەموو'], $n);
		    ?>
		</div>
	    </div>
	</div>
	<?php
	$i = 0;
	$now = date_create(date("Y-m-d H:i:s"));
	$news_txt = "news.txt";
	
	if(@filesize($news_txt) > 0)
	{
	    $f = fopen($news_txt, "r");
	    while(! feof($f))
	    {
		if($n == $i) break;
		
		$ln = fgets($f);
		$ln = json_decode($ln, true);
		
		if($ln["op"] != "add") continue;

		$pt = $ln["poetID"];
		$bk = $ln["bookID"];
		$pm = $ln["poemID"];
		$date = @date_create($ln["date"]);
		$diff = format_DD(date_diff($now,$date,true));

		$q = "select takh,bks from auth where id=$pt";
		include(ABSPATH . "script/php/condb.php");
		if(! $query) continue;
		
		$res = mysqli_fetch_assoc($query);
		$poet = $res["takh"];
		$book = explode("," , $res["bks"])[$bk-1];

		$tbl = "tbl{$pt}_{$bk}";
		$q = "select name from $tbl where id=$pm";
		$query = mysqli_query($conn, $q);
		if(! $query) continue;
		
		$poem = mysqli_fetch_assoc($query)["name"];
		$image_uri = _R . get_poet_image($pt,false);
		
		echo "<div style='margin:1.2em 0'><a class='link-news' 
href='"._R."poet:$pt/book:$bk/poem:$pm'><img style='display:inline-block;
vertical-align:middle;width:2.5em;border-radius:50%;margin-left:.25em' 
src='$image_uri'> $poet &rsaquo; $book &rsaquo; $poem</a
><i style='font-size:.88em;display:block'><i class='material-icons'
>date_range</i> $diff</i></div>";
		$i++;
		mysqli_close($conn);
	    }
	    fclose($f);
	}
	?>
    </div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
