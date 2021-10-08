<?php
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › چوونەژوور";
$desc = "چوونەژوور";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<style>
 form {
	 max-width:600px;
	 margin:auto;
 }
 input {
	 width:100%;
	 font-size:1.1em;
	 text-align:center;
 }
</style>
<div id="poets" style="font-size:.55em;text-align:right">
	<h1 style="font-size:2em" class="color-blue">
		چوونەژوور
	</h1>
	<form method="post" action="index.php">
		<input type="password"
		       name="password"
		       placeholder="تێپەڕوشە">
	</form>
	<script>
	 document.querySelector("input[name=password]").focus()
	</script>
</div>
<?php
require_once("../footer.php");
?>
