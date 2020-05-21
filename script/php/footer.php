</main> <?php /* header.php */ ?>
<?php
$no_foot = isset($_GET['nofoot']);
if(!$no_foot) {
?>
	<footer id="footer">
		<?php
		include('footer-links.php');
		?><button onclick="window.scrollTo(0,0)"
			  title="<?php P("top"); ?>" 
		  ><i class="material-icons"
		   >arrow_upward</i></button>
	</footer>
	<div class="loader-round" id="main-loader"></div>
	<script defer src='<?php echo _R; ?>script/js/main-comp.js?v312'></script>
	<script>
	 /* Colors */
	 let colors = [<?php
		       foreach($_colors as $_c) echo "'$_c',";
		       ?>];
	 /* Language-specific constants */
	 let site_lang = "<?php echo $site_lang; ?>";
	 let site_lang_cc = "<?php echo $site_lang_cc; ?>";
	 let site_dir = "<?php echo $site_dir; ?>";
	 let site_align = "<?php echo $site_align; ?>";
	 let site_anti_align = "<?php echo $site_anti_align; ?>";
	 let site_lang_show = "<?php P("language"); ?>";
	 /* Ajax-save toggle */
	 let ajax_save_p = <?php echo @$_COOKIE["ajax_save_p"] === "0" ?
				      "false" : "true"; ?>;
	 let ajax_save_days = <?php echo @filter_var($_COOKIE["ajax_save_d"],
						     FILTER_VALIDATE_INT) ?
					 abs($_COOKIE["ajax_save_d"]) : 0.25; ?>;
	 let ajax_save_duration = ajax_save_days * 24 * 60 * 60 * 1000;
	 /* Users can/should evaluate their own code. */
	 const userCodes = localStorage.getItem('user-codes') || false;
	 try { eval(userCodes); }
	 catch(e)
	 { console.error(`"user-codes" Can not be evaluated.\n${e}`); }
	</script>
</body>
</html>
<?php
} // no-foot
?>
