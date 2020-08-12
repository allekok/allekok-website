<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; تازەکان";
$desc = $title;
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
/* Number of poems */
$n = (@filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE) ?
     $_GET['n'] : 20;
?>
<style>
 .link-news {
	 display:block;
	 padding-top:.75em;
	 margin:0;
	 border-top:1px solid;
 }
 .tmi-news
 {
	 padding:0 .6em;
	 font-size:1.1em;
 }
</style>
<div id="poets" style="text-align:right">
	<h1 class="color-blue" style="font-size:1em;
		   text-align:right">
		<?php P("news"); ?>
	</h1>
	<div style="font-size:.6em;padding-right:2em">
		<div class="tools-menu">
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
		 function loadNews (n) {
			 const res = document.getElementById("result");
			 res.innerHTML = '<div class="loader"></div>';
			 getUrl(`get-news.php?n=${n}`, function (html) {
				 res.innerHTML = html;
				 ajax();
			 });
		 }
		 <?php if(!$no_head) { ?>
		 window.addEventListener("load", function () {
		 <?php } ?>
			 loadNews("<?php echo $n ?>");
			 <?php if(!$no_head) { ?>
		 });
			 <?php } ?>
		</script>
	</div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
