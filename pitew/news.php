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
     .item {
	 border-bottom:1px solid #f0f0f0;
     }
     .link {
	 display:block;
	 border-bottom:0;
	 padding:.2em 1em;
     }
     .link i {
	 font-size:.85em;
	 color:#444;
     }
    </style>
    <h1 style="color: #222;display: inline-block;margin: 1em 0;font-size: 1.2em;">
	<i class="material-icons">new_releases</i>
        تازەکانی ئاڵەکۆک
    </h1>
    <main style="max-width:800px;margin:auto;font-size:.6em;text-align:right;">
	<?php
	// get new added poems.
	
	$n = filter_var(@$_GET["n"],FILTER_VALIDATE_INT) ? $_GET["n"] : 30; // number of poems
	$i = 0; // counter

	$now = date_create(date("Y-m-d H:i:s"));
	
	$uri = "news.txt";
	$f = fopen($uri, "r");
	while(! feof($f)) {
	    if($n==$i) break;
	    
	    $ln = fgets($f);
	    $ln = json_decode($ln, true);
	    
	    if($ln["op"]!="add") continue;

	    $pt = $ln["poetID"];
	    $bk = $ln["bookID"];
	    $pm = $ln["poemID"];
	    $date = @date_create(@$ln["date"]);
	    $diff = format_DD(date_diff($now,$date,true));

	    $db = "index";
	    $q = "select takh,bks from auth where id=$pt";
	    include(ABSPATH . "script/php/condb.php");

	    $res = mysqli_fetch_assoc($query);
	    $poet = $res["takh"];
	    $book = explode(",",$res["bks"])[$bk-1];

	    $tbl = "tbl{$pt}_{$bk}";
	    $q = "select name from $tbl where id=$pm";
	    $query = mysqli_query($conn, $q);
	    $poem = mysqli_fetch_assoc($query)["name"];

	    mysqli_close($conn);
	    echo "<div class='item'><a class='link' href='/poet:$pt/book:$bk/poem:$pm'><span style='color:" . $colors[color_num($pt)][0] . ";font-weight:bold;'>&rsaquo;</span> <i>$poet &rsaquo; $book &rsaquo;</i> $poem</a><i style='border-right:5px solid #eee;padding:0 1em;font-size:.75em;color:#555;margin:0 1em .2em;display:block;'>$diff</i></div>";
	    $i++;
	}
	
	fclose($f);
	
	?>
    </main>
</div>
<?php include_once(ABSPATH . "script/php/footer.php"); ?>
