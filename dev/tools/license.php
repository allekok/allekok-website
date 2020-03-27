<?php
include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; کۆد";
$desc = "ئاڵەکۆک - کۆد";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<div id="poets">
    <h1 style="font-size:1em;text-align:right" class="color-blue">
	مافی کۆپی‌کردن
    </h1>
    <div style="text-align:right;font-size:.6em;
		padding:1em 2em 0 0">
	<?php
	echo str_replace(
	    "\n", "<br>", file_get_contents(
		ABSPATH . "LICENSE.POEMS"));
	?>
    </div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
