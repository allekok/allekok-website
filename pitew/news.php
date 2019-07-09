<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; تازەکان";
$desc = $title;
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>
<div id="poets">
    <style>
     .link {
	 display:block;
	 border-bottom:0;
	 padding:.2em 1em;
     }
     .link i {
	 font-size:.85em;
     }
    </style>
    <h1 style="display:inline-block;
	       padding:.1em .8em 0;font-size:1.2em">
        تازەکانی ئاڵەکۆک
    </h1>
    <main style="max-width:800px;margin:auto;font-size:.6em;text-align:right">
	<?php
	$n = filter_var(@$_GET["n"],FILTER_VALIDATE_INT) ?
	     $_GET["n"] : 15; /* Number of poems */
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

		$db = "index";
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
		$image_uri = get_poet_image($pt,true);
		
		echo "<div class='border-bottom-eee'><a class='link' 
href='/poet:$pt/book:$bk/poem:$pm'><img style='display:inline-block;
vertical-align:middle;width:3em;border-radius:50%;margin-left:.25em' 
src='$image_uri'> <i class='color-444'>$poet &rsaquo; $book &rsaquo;</i
> $poem</a><i class='color-555 border-right-eee' style='padding:0 1em;
font-size:.75em;margin:0 1em .2em;display:block'>$diff</i></div>";
		$i++;
		mysqli_close($conn);
	    }
	    fclose($f);
	}
	?>
    </main>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
