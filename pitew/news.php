<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = "";
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
	 border-bottom-color:#f3f3f3;
     }
     .link i {
	 font-size:.85em;
	 color:#444;
     }
    </style>
    <h1 style="color: #222;display: inline-block;margin: 1em 0;font-size: 1.2em;">
        تازەکانی ئاڵەکۆک
    </h1>
    <main style="max-width:800px;margin:auto;font-size:.6em;text-align:right;">
	<?php
	// get new added poems.
	
	$n = 100; // number of poems
	$i = 0; // counter
	
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
	    echo "<a class='link' href='/poet:$pt/book:$bk/poem:$pm'><span style='color:" . $colors[color_num($pt)][0] . ";'>&bull;</span> <i>$poet &rsaquo; $book &rsaquo;</i> $poem</a>";
	    $i++;
	}
	
	fclose($f);
	?>
    </main>
</div>
<?php include_once(ABSPATH . "script/php/footer.php"); ?>
