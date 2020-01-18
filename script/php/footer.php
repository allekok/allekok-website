</main> <?php /* header.php */ ?>
<?php
$no_foot = isset($_GET['nofoot']);
if(!$no_foot) {
?>
    <footer id="footer">
	<?php
	include('footer-links.php');
	?><a href="#" title="<?php P("top"); ?>"
	  ><i class="material-icons"
	   >arrow_upward</i></a>
    </footer>
    <div class="loader-round" id="main-loader"></div>
    <script defer src='<?php echo _R; ?>script/js/main-comp.js?v7'></script>
    <script>	 
     /* Users can evaluate their own code. */
     const userCodes = localStorage.getItem('user-codes') || false;
     try
     {
	 eval(userCodes);
     }
     catch(e)
     {
	 console.warn(`"user-codes" Can not be evaluated.\n${e}`);
     }
     /* Language-specific constants */
     const site_lang = "<?php echo $site_lang; ?>";
     const site_lang_cc = "<?php echo $site_lang_cc; ?>";
     const site_dir = "<?php echo $site_dir; ?>";
     const site_align = "<?php echo $site_align; ?>";
     const site_anti_align = "<?php echo $site_anti_align; ?>";
     const site_lang_show = "<?php P("language"); ?>";
    </script>
</body>
</html>
<?php
} // no-foot
?>
