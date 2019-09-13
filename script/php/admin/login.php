<?php
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; چوونەژوورەوە";
$desc = $title;
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 form {
     max-width:600px;
     margin:auto;
 }
 input {
     width:100%;
     font-size:.6em;
     text-align:center;
 }
</style>
<div id="poets">
    <form method="post" action="index.php">
	<input type="password" name="password"
	       placeholder="تێپەڕوشە" />
    </form>
    <script>
     document.querySelector("input[name=password]").focus();
    </script>
</div>
<?php include_once(ABSPATH . "script/php/footer.php"); ?>
