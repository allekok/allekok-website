<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; پەراوێزی شیعرەکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شیعرەکان";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");

/* Number of comments */
$n = @filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET['n'] : 20;
?>
<style>
 .tmi-news
 {
	 padding:0 .6em;
	 font-size:1.1em;
 }
</style>
<div id="poets">
	<h1 class="color-blue" style="font-size:1em;text-align:right">
		پەراوێزی شیعرەکان
	</h1>
	<div class="tools-menu" style="font-size:.6em;padding-right:2em;margin-bottom:1em">
		<div style="display:flex;font-size:1.15em">
			<div style="padding-left:1em">
				ئەژمار:
			</div>
			<div>
		<?php 
		function print_tools_menu ($all, $sel)
		{
			foreach($all as $o)
			{
				$_ = num_convert($o, 'en', 'ckb');
				
				if($o == $sel)
					echo "<span class='color-blue tmi-news'>{$_}</span>";
				elseif($sel == -1 and $_ == 'هەموو')
					echo "<span class='color-blue tmi-news'>هەموو</span>";
				else
				{
					if($o == 'هەموو') $o = -1;
					echo "<a href='?n=$o' class='tmi-news'>{$_}</a>";
				}
			}
		}

		print_tools_menu(['70','35','20','هەموو'], $n);
		?>
			</div>
		</div>
	</div>
	<div id="result"></div>
	<script>
	 function loadComments (n) {
		 const result = document.getElementById("result");
		 result.innerHTML = "<div class='loader'></div>";
		 getUrl(`get-comments.php?n=${n}`, function (resp) {
			 resp = JSON.parse(resp);
			 let accum = "";
			 for(const comment of resp) {
				 accum += `<div class='comment'><div class='comm-name'
>${comment.name}<span 
style='font-size:.7em'> سەبارەت بە شیعری </span><a
style='font-size:.75em;padding:0 .3em' 
href='${_R + comment.address}'><i class='color-blue'>${comment.ptn}</i
> &rsaquo; <i class='color-blue'>${comment.pmn}</i></a
><span style='font-size:.7em'> نووسیویەتی:</span></div
><div class='comm-body'>${comment.comment}</div><div class='comm-footer'
>${comment.date}</div></div>`;
			 }
			 result.innerHTML = accum;
		 });
	 }
	 <?php if(! $no_head) { ?>
	 window.addEventListener("load", function () {
	 <?php } ?>
		 loadComments("<?php echo $n; ?>");
		 <?php if(! $no_head) { ?>
	 });
		 <?php } ?>
	</script>
</div>
<?php
include_once(ABSPATH . 'script/php/footer.php');
?>
