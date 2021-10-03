<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › مدیر";
$desc = "مدیر";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<style>
 .line {
	 text-align:right;
	 font-family:"kurd", monospace;
	 font-size:1.15em;
	 padding-right:1em;
 }
 .line a {
	 padding:.3em;
	 display:block;
 }
</style>
<div id="poets" style="font-size:.55em;text-align:right">
	<h1 style="font-size:2em" class="color-blue">
		مدیر
	</h1>
	<?php
	$files = scandir(".");
	rsort($files);
	$ignore = [
		".",
		"..",
		"IP-blacklist.php",
		"IP-blacklist-sample.php",
		"SHA512.php",
		"capture",
		"comment-block.php",
		"comment-read.php",
		"index.php",
		"link-ganjoor.php",
		"login.php",
		"password.php",
		"password-sample.php",
		"session.php",
		"error_log",
		".htaccess",
		"sql-columns.php",
		"get-pitew.php",
		"set-pitew.php",
		"normalize.php",
		"install.php",
	];
	foreach($files as $f) {
		if(!in_array($f, $ignore)) {
			echo "<p class='line'>" .
			     "<a class='link' href='$f'>" .
			     "› " .
			     substr($f, 0, -4) .
			     "</a></p>";
		}
	}
	?>
</div>
<?php
require_once("../footer.php");
?>
