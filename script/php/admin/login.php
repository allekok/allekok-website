<?php
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; چوونەژوورەوە";
$desc = $title;
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

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
</div>

<?php include_once(ABSPATH . "script/php/footer.php"); ?>
