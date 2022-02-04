<?php
require_once("../script/php/constants.php");
require_once("../script/php/colors.php");
require_once("../script/php/functions.php");

$title = $_TITLE . " › پەراوێزی شیعرەکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شیعرەکان";
$keys = $_KEYS;
$t_desc = "";

require_once("../script/php/header.php");

/* User Input */
$n = isset($_GET["n"]) ? intval($_GET["n"]) : 20;
$from = isset($_GET["from"]) ? intval($_GET["from"]) : 0;
?>
<style>
 .tmi-news {
	 padding:0 .6em;
	 font-size:1.1em;
 }
</style>
<div id="poets">
	<h1 class="color-blue" style="font-size:1em;text-align:right">
		پەراوێزی شیعرەکان
	</h1>
	<div class="tools-menu"
	     style="font-size:.6em;padding-right:2em;margin-bottom:1em">
		<div style="display:flex;font-size:1.15em">
			<div style="padding-left:1em">
				ئەژمار:
			</div>
			<div>
		<?php
		function print_tools_menu($all, $sel) {
			foreach($all as $o) {
				$_ = num_convert($o, "en", "ckb");
				if($o == $sel) {
					echo "<span class='color-blue " .
					     "tmi-news'>{$_}</span>";
				}
				elseif($sel == -1 and $_ == "هەموو") {
					echo "<span class='color-blue " .
					     "tmi-news'>هەموو</span>";
				}
				else {
					if($o == "هەموو")
						$o = -1;
					echo "<a href='?n=$o' " .
					     "class='tmi-news'>{$_}</a>";
				}
			}
		}
		print_tools_menu(["70", "35", "20", "هەموو"], $n);
		?>
			</div>
		</div>
	</div>
	<div id="result"></div>
</div>
<script>
 <?php
 if(!$no_head)
	 echo "window.addEventListener('load', () => {";
 ?>
 
 loadComments(<?php echo "'$n', '$from'" ?>)
 
 <?php
 if(!$no_head)
	 echo "})";
 ?>
 
 function loadComments(n, from) {
	 const result = document.getElementById('result')
	 result.innerHTML = '<div class="loader"></div>'
	 getUrl(`get-comments.php?n=${n}&from=${from}`, resp => {
		 resp = JSON.parse(resp)
		 const html = resp.map(commentToHtml).reduce((x, y) => x + y)
		 result.innerHTML = html
	 })
 }
 
 function commentToHtml(c) {
	 return `<div class="comment"><div class="comm-name">` +
		`${c.name}<span style="font-size:.7em"> سەبارەت بە شیعری ` +
		`</span><a style="font-size:.75em;padding:0 .3em" href="` +
		`${_R + c.address}"><i class="color-blue">${c.ptn}</i> › ` +
		`<i class="color-blue">${c.pmn}</i></a><span style="` +
		`font-size:.7em"> نووسیویەتی:</span></div><div class="` +
		`comm-body">${c.comment}</div><div class="comm-footer">` +
		`${c.date}</div></div>`
 }
</script>
<?php
require_once("../script/php/footer.php");
?>
