<?php
require_once("functions.php");

$all_colors = [
	"light" => ["#fff", "#000", "#00e", "#e00"],
	"dark" => ["#000", "#fff", "#5f5", "#f55"]
];
$_theme = @filter_var($_COOKIE["theme"], FILTER_SANITIZE_STRING);
$_theme_light = ($_theme == "light");
$_theme_dark = ($_theme == "dark");
$_theme_custom = ($_theme == "custom");
$_auto_theme = false;
$_colors = [];
if($_theme_custom) {
	$_colors = explode(",", @filter_var(
		$_COOKIE["colors"],
		FILTER_SANITIZE_STRING));
	for($i = 0; $i < 4; $i++)
		if(!isset($_colors[$i]))
			$_colors[$i] = "";
	/* Background Image */
	if(isset($_COOKIE["backimg"])) {
		$_back_img = filter_var(urldecode($_COOKIE["backimg"]), FILTER_SANITIZE_STRING);
		$_back_img_size = @filter_var($_COOKIE["backimgsize"], FILTER_SANITIZE_STRING);
		$_back_img_repeat = @filter_var($_COOKIE["backimgrepeat"], FILTER_SANITIZE_STRING);
		$_back_img_attach = @filter_var($_COOKIE["backimgattach"], FILTER_SANITIZE_STRING);
		$_back_img_pos = @filter_var($_COOKIE["backimgpos"], FILTER_SANITIZE_STRING);
		$_back_img_op = @num_convert($_COOKIE["backimgop"], "ckb", "en");
		$_back_img_op = @num_convert($_back_img_op, "fa", "en");
		if(filter_var($_back_img_op, FILTER_VALIDATE_FLOAT) !== FALSE)
			$_back_img_op = floatVal($_back_img_op);
		if(!($_back_img_op >= 0 and $_back_img_op <= 1)) $_back_img_op = "1.0";
	}
}
elseif($_theme_dark)
	$_colors = $all_colors["dark"];
elseif($_theme_light)
	$_colors = $all_colors["light"];
else {
	$_auto_theme = true;
	$_colors = $all_colors["light"];
}
?>
