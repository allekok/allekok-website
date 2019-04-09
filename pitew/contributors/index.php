<?php

include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک &raquo; بەشداربووان";
$desc = "بەشداربووان و یارمەتیدەرانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>

<div id="poets" style="margin-bottom:4em;max-width:800px">
    <div id='adrs'>
	<a href="../first.php">
	    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<div id='current-location'>
	    <i style='vertical-align:middle;' class='material-icons'>favorite</i>
	    بەشداربووان
	</div>
    </div>

    <style>
     #contributions div p {
	 text-align:right;
     }
     #contributions div .stats-min {
	 display:block;
	 font-size:.9em;
     }
     #contributions div .stats-min .material-icons {
	 font-size:.85em;
	 vertical-align:middle;
	 padding:0 .2em;
	 display:inline-block;
     }
     .epld-expand {
	 font-size:1em;
	 padding:0 .5em;
	 margin:1em 0;
	 background:#666;
	 color:#fff;
     }
     .epld-expand i {
	 vertical-align:middle;
     }
    </style>
    <script>
     function expand(item) {
	 var parent = item.
		     parentNode.
		   parentNode.querySelector("div");
	 if(parent.style.overflow != "hidden") {
	     parent.style.overflow = "hidden";
	     parent.style.maxHeight = "400px";
	     item.innerHTML = "<i class='material-icons' style='font-size:inherit;display:inline-block'>keyboard_arrow_down</i>";
	 } else {
	     parent.style.overflow = "";
	     parent.style.maxHeight = "";
	     item.innerHTML = "<i class='material-icons' style='font-size:inherit;display:inline-block'>keyboard_arrow_up</i>";	     
	 }
     }
    </script>
    
    <div id="contributions">
	<?php
	function open($uri, $limit=-2) {
	    $f = fopen($uri, 'r');
	    $array = [];
	    $n = -1;
	    while(! feof($f)) {
		if($limit === $n) break;
		$line = fgets($f);
		if(!trim($line)) continue;
		$array[] = explode("\t", $line);
		$n++;
	    }
	    return $array;
	}
	?>
	<?php
	$array = [
	    ['poems', 'نووسینی شێعر', 'poems.txt', 'note_add'],
	    ['images', 'ناردنی وێنەی شاعیران', 'images.txt', 'image'],
	    ['poet-descs', 'نووسینی زانیاری سەبارەت بە شاعیران', 'poet-descs.txt', 'person'],
	    ['comments', 'ڕاست‌کردنەوەی هەڵەکانی ناو شێعر', 'comments.txt', 'question_answer'],
	    ['pdfs', 'ناردنی دیوانی شاعیران', 'pdfs.txt', 'cloud_download'],
	];

	foreach($array as $E) {
	    echo "<div id='contributions-{$E[0]}' class='pitewsec'>";
	    echo "<div style='overflow:hidden;max-height:400px'><i class='material-icons'>{$E[3]}</i>";
	    echo '<h3>';
	    echo $E[1];
	    $contributions_poems = open($E[2]);
	    echo '<small><i class=\'stats-min\'>';
	    echo "<a href='{$E[2]}' title='وەشانی plain/text'><i class='material-icons'>insert_drive_file</i></a>";
	    echo 'ئەژمار: ';
	    echo num_convert(
		number_format(
		    array_shift($contributions_poems)[0]),'en','ckb');
	    echo '</i>';
	    $n = 1;
	    foreach($contributions_poems as $e) {
		if(trim($e[1]) == 'ناشناس' or trim($e[1]) == 'ئاڵەکۆک')
		    continue;
		echo '<p>';
		echo num_convert(($n).'. '.trim($e[1]), 'en', 'ckb');
		echo '</p>';
		$n++;
	    }
	    echo '</small></h3>';
	    echo "</div><div><button class='epld-expand button' onclick='expand(this)'><i class='material-icons' style='font-size:inherit;display:inline-block'>keyboard_arrow_down</i></button></div>";
	    echo '</div>';
	}

	?>
    </div>

</div>


<?php
include_once(ABSPATH."script/php/footer.php");
?>
