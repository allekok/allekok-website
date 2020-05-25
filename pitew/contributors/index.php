<?php
include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo; بەشداربووان";
$desc = "بەشداربووان و یارمەتیدەرانی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 #contributions .pitewsec {
     max-width:450px;
     margin:auto;
 }
 #contributions div small {
     display:block;
     padding-right:2em;
 }
 #contributions div .stats-min {
     display:block;
     font-size:.95em;
 }
 #contributions div .stats-min .material-icons {
     font-size:1.1em;
     padding:0 0 0 .2em;
     display:inline-block;
 }
 #contributions .epld-expand {
     font-size:1em;
     padding:0 .5em;
     display:block;
     margin-right:1em
 }
</style>
<div id="poets" style="text-align:right">
    <div id='adrs'>
	<a href="<?php echo _R; ?>pitew/first.php">
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
	     'note_add', _R.'pitew/poem-list.php'],
	    ['images', 'ناردنی وێنەی شاعیران', 'images.txt',
	     'image', _R.'pitew/image-list.php'],
	    ['poet-descs', 'نووسینی زانیاری سەبارەت بە شاعیران',
	     'poet-descs.txt', 'person', _R.'pitew/poetdesc-list.php'],
	    ['comments', 'ڕاست‌کردنەوەی هەڵەکانی ناو شێعر',
	     'comments.txt', 'question_answer', _R.'comments/'],
	    ['pdfs', 'ناردنی دیوانی شاعیران', 'pdfs.txt',
	     'cloud_download', _R.'pitew/pdfs.php'],
	    ['donations', 'یارمەتیی ماڵی', 'donations.txt',
	     "money", _R.'donate/'],
	];

	foreach ($array as $E)
	{
	    echo "<div id='contributions-{$E[0]}' class='pitewsec'>";
	    echo "<div style='overflow:hidden;max-height:300px'>";
	    echo "<a href='{$E[4]}'>";
	    echo "<i class='material-icons'>{$E[3]}</i> ";
	    echo '<h3>';
	    echo $E[1];
	    echo "</a></h3>";
	    $contributions_poems = open($E[2]);
	    echo '<small><i class=\'stats-min\'>';
	    echo "<a target='_blank' href='{$E[2]}' title='وەشانی plain/text'
><i class='material-icons'>insert_drive_file</i></a>";
	    echo 'ئەژمار: ';
	    echo '<i style="padding-left:2em">';
	    echo num_convert(
		number_format(
		    $contributions_poems[0][1]),'en','ckb');
	    echo 'کەس</i><i>';
	    echo num_convert(
		number_format(
		    array_shift($contributions_poems)[0]),'en','ckb');
	    echo 'جار</i>';
	    echo '</i>';
	    $n = 1;
	    foreach($contributions_poems as $e) {
		if(trim($e[1]) == 'ناشناس' or trim($e[1]) == 'ئاڵەکۆک')
		    continue;
		$e[1] = trim($e[1]);
		echo '<p style="display:flex;border-bottom:1px solid">';
		echo "<i style='width:70%'>" .
		     num_convert($n, 'en', 'ckb') . '. ' .
		     "<a href='{$E[4]}?name={$e[1]}'>".$e[1]."</a></i><i ".
		     "style='width:30%;text-align:left'>".
		     num_convert($e[0],"en","ckb")." جار</i>";
		echo '</p>';
		$n++;
	    }
	    echo '</small>';
	    echo "</div><div><button class='epld-expand'
><i class='material-icons' 
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
	 parent.style.maxHeight = "300px";
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
 document.querySelectorAll('.epld-expand').forEach(function (o)
     {
	 o.onclick = function () {expand(o)}
 });
</script>
<?php
include_once(ABSPATH."script/php/footer.php");
?>
