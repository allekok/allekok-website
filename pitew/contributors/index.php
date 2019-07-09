<?php
include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; بەشداربووان";
$desc = "بەشداربووان و یارمەتیدەرانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>
<div id="poets" style="margin-bottom:1em;max-width:800px">
    <div id='adrs'>
	<a href="../first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i> &rsaquo; </i>
	<div id='current-location'>
	    <i class='material-icons'>favorite</i>
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
	 font-size:1.3em;
	 padding:0 .5em;
	 margin:.5em 0;
     }
    </style>
    <script>
     function expand (item)
     {
	 const parent = item.parentNode.
			   parentNode.querySelector("div");
	 if(parent.style.overflow != "hidden") {
	     parent.style.overflow = "hidden";
	     parent.style.maxHeight = "400px";
	     item.innerHTML = "<i class='material-icons' \
style='font-size:inherit;display:inline-block'\
>keyboard_arrow_down</i>";
	 }
	 else
	 {
	     parent.style.overflow = "";
	     parent.style.maxHeight = "";
	     item.innerHTML = "<i class='material-icons' \
style='font-size:inherit;display:inline-block'\
>keyboard_arrow_up</i>";	     
	 }
     }
    </script>
    <div id="contributions">
	<?php
	function open ($uri, $limit=-2)
	{
	    if(! file_exists($uri))
		return [];
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
	
	$array = [
	    ['poems', 'نووسینی شێعر', 'poems.txt',
	     'note_add', '/pitew/poem-list.php'],
	    ['images', 'ناردنی وێنەی شاعیران', 'images.txt',
	     'image', '/pitew/image-list.php'],
	    ['poet-descs', 'نووسینی زانیاری سەبارەت بە شاعیران',
	     'poet-descs.txt', 'person', '/pitew/poetdesc-list.php'],
	    ['comments', 'ڕاست‌کردنەوەی هەڵەکانی ناو شێعر',
	     'comments.txt', 'question_answer', '/comments/'],
	    ['pdfs', 'ناردنی دیوانی شاعیران', 'pdfs.txt',
	     'cloud_download', '/pitew/pdfs.php'],
	];

	foreach ($array as $E)
	{
	    echo "<div id='contributions-{$E[0]}' class='pitewsec'>";
	    echo "<div style='overflow:hidden;max-height:400px'
><i class='material-icons'>{$E[3]}</i>";
	    echo '<h3>';
	    echo "<a href='{$E[4]}'>";
	    echo $E[1];
	    echo "</a>";
	    $contributions_poems = open($E[2]);
	    echo '<small><i class=\'stats-min\'>';
	    echo "<a href='{$E[2]}' title='وەشانی plain/text'
><i class='material-icons'>insert_drive_file</i></a>";
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
	    echo "</div><div><button class='epld-expand color-444 button' 
onclick='expand(this)'><i class='material-icons' 
style='font-size:inherit;display:inline-block'
>keyboard_arrow_down</i></button></div>";
	    echo '</div>';
	}
	?>
    </div>
</div>
<?php
include_once(ABSPATH."script/php/footer.php");
?>
