</main> <?php /* header.php */ ?>
<?php
$no_foot = isset($_GET['nofoot']);
if(!$no_foot) {
?>
    <footer id="footer">
	<?php
	include('footer-links.php');
	?><a href="#" title="چوونە سەرەوە"
	  ><i class="material-icons"
	   >arrow_upward</i></a>
    </footer>
    <div class="loader-round" id="main-loader"></div>
    <script defer src='<?php echo _R; ?>script/js/main-comp.js?v3'></script>
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
    </script>
</body>
</html>
<?php
} // no-foot
?>
