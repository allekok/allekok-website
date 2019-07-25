<?php
include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; بەشداربووان";
$desc = "بەشداربووان و یارمەتیدەرانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 #contributions div small {
     display:block;
     padding-right:2em;
 }
 #contributions div .stats-min {
     display:block;
     font-size:.85em;
 }
 #contributions div .stats-min .material-icons {
     font-size:1.1em;
     padding:0 0 0 .2em;
     display:inline-block;
 }
 .epld-expand {
     font-size:1em;
     padding:0 .5em;
     display:block;
     margin-right:1em
 }
</style>
<div id="poets" style="text-align:right">
    <div id='adrs'>
	<a href="/pitew/first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i> &rsaquo; </i>
	<div id='current-location'>
	    <i class='material-icons'>favorite</i>
	    بەشداربووان
	</div>
    </div>

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
	    echo "<div style='overflow:hidden;max-height:200px'>";
	    echo "<a href='{$E[4]}'>";
	    echo "<i class='material-icons'>{$E[3]}</i> ";
	    echo '<h3>';
	    echo $E[1];
	    echo "</a></h3>";
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
	    echo '</small>';
	    echo "</div><div><button class='epld-expand' 
onclick='expand(this)'><i class='material-icons' 
style='font-size:inherit;display:inline-block'
>keyboard_arrow_down</i></button></div>";
	    echo '</div>';
	}
	?>
    </div>
</div>
<script>
 function expand (item)
 {
     const parent = item.parentNode.
			 parentNode.querySelector("div");
     if(parent.style.overflow != "hidden") {
	 parent.style.overflow = "hidden";
	 parent.style.maxHeight = "200px";
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
<?php
include_once(ABSPATH."script/php/footer.php");
?>
