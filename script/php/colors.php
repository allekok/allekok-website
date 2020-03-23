<?php
$_theme = @filter_var($_COOKIE['theme'], FILTER_SANITIZE_STRING);
$_theme_dark = ($_theme == 'dark');
$_theme_custom = ($_theme == 'custom');
$_colors = [];
if($_theme_custom) {
    $_colors = explode(",", @filter_var(
	$_COOKIE['colors'],
	FILTER_SANITIZE_STRING));
    for($i = 0; $i < 4; $i++)
	if(!isset($_colors[$i]))
	    $_colors[$i] = "";
}
elseif($_theme_dark) $_colors = ['#222','#fff','#cf0','#f55'];
else $_colors = ['#fff','#000','#00e','#e00'];
?>
