<?php
require_once("../script/php/constants.php");
require_once("../script/php/colors.php");
require_once("../script/php/functions.php");

$title = $_TITLE . "؟";
$desc = $title;
$keys = $_KEYS;
$t_desc = "";

require_once("../script/php/header.php");
?>
<div id="poets">
	<h1 class="color-blue" style="font-size:1em;text-align:right">
		سەبارەت
	</h1>
	<div style="text-align:right;font-size:.6em;padding-right:1em">
		<p>
			ئاڵەکۆک، هەلێکە بۆ خوێندنەوەی هۆنراوەی کوردی.
		</p>
		<p>
			دواهەمین نوێ کردنەوەی شیعرەکان: 
			<?php
			$last_upd_file = "../last-update.txt";
			if(file_exists($last_upd_file)) {
				$last_update_date = date_create(
					file_get_contents($last_upd_file));
				$now = date_create(date("Y-m-d H:i:s"));
				echo format_DD(date_diff($now,
							 $last_update_date,
							 TRUE));
			}
			?>
		</p>
		<p>
			ئەژمار: 
			<?php require_once("../script/php/stats.php"); ?>
			<i class="sub-num">
				<?php echo $aths_num; ?>
			</i>
			هۆنەر
			›
			<i class="sub-num">
				<?php echo $hons_num; ?>
			</i>
			هۆنراوە
		</p>
	</div>
	<div style="margin:0 auto">
		<div id="message"></div>
		<form id="frmComm"
		      method="POST"
		      action="<?php echo _R ?>about/append.php">
			<textarea id="commTxt"
				  placeholder="ئاڵەکۆک‌تان بەلاوە چۆنە؟ بۆمان بنووسن..."
				  style="font-size:.65em;
				      max-width:100%;
				      width:100%"></textarea>
			<div class="loader"
			     id="commloader"
			     style="display:none;margin:.5em auto .2em"></div>
			<button type="submit"
				      class="button" 
				      style="font-size:.7em;
				      padding:.5em 1.5em">ناردن</button>
		</form>
		<?php
		require_once("functions.php");
		$empty_comments = file_exists(comments_file) ?
				  !filesize(comments_file) :
				  TRUE;
		?>
		<h1 id="Acomms-title"
		    class="color-blue"
			style="text-align:right;
			margin:0 0 .5em;
			font-size:1em;
			<?php if($empty_comments) echo "display:none"; ?>"
		>پەراوێز</h1>
		<div id="Acomms"
		     style="font-size:.6em;
			 margin:auto;
			 <?php
			 if($empty_comments)
				 echo "display:none";
			 ?>">
			<div class="loader" style="padding:0"></div>
		</div>
	</div>
</div>
<script>
 <?php
 if(!$no_head)
	 echo "window.addEventListener('load', () => {";
 ?>
 getUrl('about-comments.php', html => 
	 document.getElementById('Acomms').
		  innerHTML = html)
 <?php
 if(!$no_head)
	 echo "})";
 ?>

 document.getElementById('frmComm').addEventListener('submit', e => {
	 e.preventDefault()
	 append()
 })
 
 function append() {
	 const res = document.getElementById('message'),
	       comm = document.getElementById('commTxt'),
	       loader = document.getElementById('commloader'),
	       succMess = '<i class="color-blue" ' +
			  'style="display:block;font-size:.5em">' +
			  'زۆر سپاس بۆ دەربڕینی بیر و ڕاتان سەبارەت بە ئاڵەکۆک.</i>',
	       failMess = '<i class="color-red" ' +
			  'style="display:block;font-size:.5em">' +
			  'کێشەیەک هەیە. تکایە دووبارە هەوڵ دەنەوە.</i>',
	       OoRError = '<i class="color-red" ' +
			  'style="display:block;font-size:.5em">' +
			  'ژمارەی پیتەکان نابێ لە ٢٦٨٥ پیت زیاتر بێت.</i>',
	       request = 'comm=' + encodeURIComponent(comm.value)
	 
	 if(!comm.value) {
		 comm.focus()
		 return
	 }
	 
	 if(comm.value.length > 2685) {
		 res.innerHTML = OoRError
		 comm.style.borderColor = '<?php echo $_colors[3] ?>'
		 comm.focus()
		 setTimeout(() => comm.style.borderColor = '', 3000)
		 return
	 }
	 
	 loader.style.display = 'block'

	 postUrl('<?php echo _R ?>about/append.php', request, response => {
		 response = JSON.parse(response)
		 if(response.message == 'ok') {
			 const Acomms = document.getElementById('Acomms'),
			       ATitle = document.getElementById('Acomms-title')
			 res.innerHTML = succMess
			 comm.style.borderColor = '<?php echo $_colors[2] ?>'
			 comm.value = ''
			 ATitle.style.display = 'block'
			 Acomms.style.display = 'block'
			 Acomms.innerHTML = response.comm + Acomms.innerHTML
		 }
		 else {
			 res.innerHTML = failMess
			 comm.style.borderColor = '<?php echo $_colors[3] ?>'
		 }
		 setTimeout(() => comm.style.borderColor = '', 3000)
		 loader.style.display = 'none'
	 })
 }
</script>
<?php
require_once("../script/php/footer.php");
?>
