<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title =
	$_TITLE .
	" &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo; ناردنی وێنەی شاعیران &rsaquo; وێنەکان";
$desc = "ئەو وێنانەی کە بۆتان ناردوویین";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');

$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET["n"] : -1;
$name = isset($_GET['name']) ?
	filter_var($_GET['name'],FILTER_SANITIZE_STRING) :
	"";
$poet = isset($_GET['poet']) ?
	filter_var($_GET['poet'],FILTER_SANITIZE_STRING) :
	"";
?>
<style>
 .imglist-con{display:flex;text-align:right;border-top:1px solid}
 .imglist{vertical-align:top;padding:.2em 1em;
	 font-size:.55em;width:100%}
</style>
<div id="poets">  
	<div id='adrs'>
		<a href="first.php">
			پتەوکردنی ئاڵەکۆک
		</a>
		<i> &rsaquo; </i>
		<a href="poet-image.php">
			<i style='vertical-align:middle;'
			   class='material-icons'>image</i>
			ناردنی وێنەی شاعیران
		</a>
		<i> &rsaquo; </i>
		<div id="current-location">
			وێنەکان
		</div>
	</div>
	<div>
		<div class="imglist-con">
			<section class='imglist color-blue'
			>یارمەتیدەر</section>
			<section class='imglist color-blue'
			>نێوی شاعیر</section>
			<section class='imglist color-blue'
			>وێنە</section>
		</div>
		<div id="result"></div>
		<script>
		 function loadImageList (n, name, poet) {
			 const result = document.getElementById("result");
			 result.innerHTML = "<div class='loader'></div>";
			 getUrl(`get-image-list.php?n=${n}&name=${name}&poet=${poet}`,
				function (resp) {
					result.innerHTML = resp;
			 });
		 }
		 <?php if(!$no_head) { ?>
		 window.addEventListener("load", function () {
		 <?php } ?>
			 loadImageList("<?php echo $n; ?>",
				       "<?php echo $name; ?>",
				       "<?php echo $poet; ?>");
			 <?php if(!$no_head) { ?>
		 });
			 <?php } ?>
		</script>
	</div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
