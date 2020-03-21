<?php
$_theme = @filter_var($_COOKIE['theme'], FILTER_SANITIZE_STRING);
$_colors = [];
$_theme_dark = ($_theme == 'dark');
$_theme_custom = ($_theme == 'custom');
if($_theme_dark)
{
    $_color = '#cf0';
    $_color_black = '#fff';
}
elseif($_theme_custom)
{
    $_colors = explode(",", @filter_var(
	$_COOKIE['colors'],
	FILTER_SANITIZE_STRING));
    for($i = 0; $i < 4; $i++)
	if(!isset($_colors[$i]))
	    $_colors[$i] = "";
    $_color = $_colors[2];
    $_color_black = $_colors[1];
}
else
{
    $_color = '#00e';
    $_color_black = '#000';
}
?>
