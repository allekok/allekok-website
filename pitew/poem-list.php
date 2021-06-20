<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$_name1 = @trim(filter_var($_GET['name'],FILTER_SANITIZE_STRING));
// number of poems
$n = (@filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE) ?
     $_GET['n'] : 20;

$title = $_name1 ?
	 $_TITLE . " &rsaquo; ئەو شیعرانەی \"$_name1\" نووسیویەتی" :
	 $_TITLE . " &rsaquo; ئەو شیعرانەی نووسیوتانە";
$desc = "ئەو شیعرانەی نووسیوتانە";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<style>
 .tmi-news
 {
	 padding:0 .6em;
	 font-size:1.1em;
 }
 .pmlist-container{border-top:1px solid}
 .pmlist-container section{vertical-align:top;padding:.2em 1em;font-size:.55em;text-align:right}
</style>
<div id="poets">
	<h1 class="color-blue" style="text-align:right;font-size:1em">
		ئەو شیعرانەی نووسیوتانە
	</h1>
	
	<?php
	$q = $_name1 ?
	     "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status`!='{\"status\":-2,\"url\":\"\",\"desc\":\"\"}' AND `contributor`='$_name1' ORDER BY `id` DESC" :
	     "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status`!='{\"status\":-2,\"url\":\"\",\"desc\":\"\"}' ORDER BY `id` DESC";
	include(ABSPATH . "script/php/condb.php");
	if(!$query) die();
	$_pmnum = num_convert(mysqli_num_rows($query), "en", "ckb");
	mysqli_close($conn);
	?>
	<div style="display:flex;font-size:.55em;
		    margin:1em 0">
		<div style="width:100%;text-align:right;
			    padding:0 .5em">
			ئەژماری شیعرەکان<?php
					if($_name1)
						echo "ی \"$_name1\"";
					echo " : <span style='letter-spacing:1.5px'>". $_pmnum . "</span>";
					?>
		</div>
		<div style='width:100%;text-align:left;
			    padding:0 .5em'>
			<?php if($_name1) { ?>
				<a href="<?php echo _R; ?>pitew/poem-list.php">
					تەواوی شیعرەکان &rsaquo;
				</a>
			<?php } ?>
		</div>
	</div>
	<div class="tools-menu" style="font-size:.6em;padding-right:2em;margin-bottom:1em">
		<div style="display:flex;font-size:1.15em">
			<div style="padding-left:1em">
				ئەژمار:
			</div>
			<div>
		<?php 
		function print_tools_menu ($all, $sel)
		{
			global $_name1;
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
					echo "<a href='?name={$_name1}&n=$o' class='tmi-news'>{$_}</a>";
				}
			}
		}

		print_tools_menu(['70','35','20','هەموو'], $n);
		?>
			</div>
		</div>
	</div>
	<div class="pmlist-container">
		<section style="width:100%"
			 class='color-blue'>یارمەتیدەر</section>
		<section style="width:100%"
			 class='color-blue'>شیعر</section>
	</div>
	<div id="result"></div>
	<script>
	 function loadPoemList (name, n) {
		 const result = document.getElementById("result");
		 result.innerHTML = "<div class='loader'></div>";
		 getUrl(`get-poem-list.php?name=${name}&n=${n}`, function (resp) {
			 result.innerHTML = resp;
			 ajax();
		 });
	 }
	 <?php if(! $no_head) { ?>
	 window.addEventListener("load", function () {
	 <?php } ?>
		 loadPoemList("<?php echo $_name1; ?>", "<?php echo $n; ?>");
		 <?php if(! $no_head) { ?>
	 });
		 <?php } ?>
	</script>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
