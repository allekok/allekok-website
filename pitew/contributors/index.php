<?php
require_once("../../script/php/constants.php");
require_once("../../script/php/colors.php");
require_once("../../script/php/functions.php");

$title = $_TITLE . " › بەشداربووان و یارمەتیدەرانی ئاڵەکۆک";
$desc = "بەشداربووان و یارمەتیدەرانی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

require_once("../../script/php/header.php");
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
	<h1 class="color-blue" style="text-align:right;font-size:1em">
		بەشداربووانی ئاڵەکۆک
	</h1>
	<div id="contributions">
		<?php
		function open($uri, $limit=-2) {
			if(!file_exists($uri))
				return [];
			$f = fopen($uri, 'r');
			$array = [];
			$n = -1;
			while(!feof($f)) {
				if($limit === $n)
					break;
				$line = fgets($f);
				if(!trim($line))
					continue;
				$array[] = explode("\t", $line);
				$n++;
			}
			return $array;
		}

		$array = [["poems",
			   "نووسینی شیعر",
			   "poems.txt",
			   "note_add",
			   _R . "pitew/poem-list.php",
			   "جار"],
			  ["images",
			   "ناردنی وێنەی شاعیران",
			   "images.txt",
			   "image",
			   _R . "pitew/image-list.php",
			   "جار"],
			  ["poet-descs",
			   "نووسینی زانیاری سەبارەت بە شاعیران",
			   "poet-descs.txt",
			   "person",
			   _R . "pitew/poetdesc-list.php",
			   "جار"],
			  ["comments",
			   "ڕاست‌کردنەوەی هەڵەکانی ناو شیعر",
			   "comments.txt",
			   "question_answer",
			   _R . "comments/",
			   "جار"],
			  ["pdfs",
			   "ناردنی دیوانی شاعیران",
			   "pdfs.txt",
			   "cloud_download",
			   _R . "pitew/pdfs.php",
			   "جار"],
			  ["donations",
			   "یارمەتیی ماڵی",
			   "donations.txt",
			   "money",
			   _R . "donate/",
			   "تمەن"]];

		foreach($array as $E) {
			echo "<div id='contributions-{$E[0]}' " .
			     "class='pitewsec'>" .
			     "<div style='overflow:hidden;max-height:300px'>" .
			     "<a href='{$E[4]}'>" .
			     "<i class='material-icons'>{$E[3]}</i> " .
			     "<h3>" .
			     $E[1] .
			     "</a></h3>";

			$contributions_poems = open($E[2]);
			echo "<small><i class='stats-min'>" .
			     "<a target='_blank' href='{$E[2]}' " .
			     "title='وەشانی plain/text'>" .
			     "<i class='material-icons'>" .
			     "insert_drive_file</i></a>" .
			     "ئەژمار: " .
			     "<i style='padding-left:2em'>" .
			     num_convert(
				     number_format($contributions_poems[0][1]),
				     "en",
				     "ckb") .
			     "کەس</i><i>" .
			     num_convert(
				     number_format(array_shift(
					     $contributions_poems)[0]),
				     "en",
				     "ckb") .
			     "$E[5]</i>" .
			     "</i>";

			$n = 1;
			foreach($contributions_poems as $e) {
				$e[1] = trim($e[1]);
				if($e[1] == "ئاڵەکۆک")
					continue;
				echo "<p style='display:flex;" .
				     "border-bottom:1px solid'>" .
				     "<i style='width:70%'>" .
				     num_convert($n, "en", "ckb") .
				     ". " .
				     "<a href='{$E[4]}?name={$e[1]}'>" .
				     $e[1] .
				     "</a></i>" .
				     "<i style='width:30%;text-align:left'>" .
				     num_convert(number_format($e[0]),
						 "en",
						 "ckb") .
				     " $E[5]</i>" .
				     "</p>";
				$n++;
			}
			echo "</small>" .
			     "</div><div><button class='epld-expand'>" .
			     "<i class='material-icons' style='" .
			     "font-size:inherit;display:inline-block'>" .
			     "keyboard_arrow_down</i></button></div>" .
			     "</div>";
		}
		?>
	</div>
</div>
<script>
 function expand(item) {
	 const parent = item.parentNode.parentNode.querySelector('div')
	 if(parent.style.overflow != 'hidden') {
		 parent.style.overflow = 'hidden'
		 parent.style.maxHeight = '300px'
		 item.innerHTML = '<i class="material-icons" ' +
				  'style="font-size:inherit;display:' +
				  'inline-block">keyboard_arrow_down</i>'
	 }
	 else {
		 parent.style.overflow = ''
		 parent.style.maxHeight = ''
		 item.innerHTML = '<i class="material-icons" ' +
				  'style="font-size:inherit;display:' +
				  'inline-block">keyboard_arrow_up</i>'
	 }
 }
 document.querySelectorAll('.epld-expand').forEach(o =>
	 o.onclick = () => expand(o))
</script>
<?php
require_once("../../script/php/footer.php");
?>
