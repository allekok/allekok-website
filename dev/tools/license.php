<?php
require_once("../../script/php/constants.php");
require_once("../../script/php/colors.php");
require_once("../../script/php/functions.php");

$title = $_TITLE . " › مافی کۆپی کردن";
$desc = "ئیجازەنامە و مافنامەی کۆپی‌ڕایتی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

require_once("../../script/php/header.php");
?>
<div id="poets">
	<h1 class="color-blue" style="font-size:1em;text-align:right">
		مافی کۆپی‌کردن
	</h1>
	<div style="text-align:justify;font-size:.6em;padding:1em 2em 0 0">
		<?php
		const license_file = "../../LICENSE.POEMS";
		if(file_exists(license_file)) {
			echo str_replace(".\n",
					 ".<br>\n",
					 file_get_contents(license_file));
		}
		?>
	</div>
</div>
<?php
require_once("../../script/php/footer.php");
?>
