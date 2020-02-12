<?php
require_once("constants.php");
/* run */
const main_css_path = main;
const dark_css_path = main_dark;
$main_css = file_get_contents(main_css_path);
$main_css = preg_replace_callback(
    "/(#)([0-9a-f]+)(})/i",
    "color_inverse_string",$main_css);
$main_css = preg_replace_callback(
    "/(#)([0-9a-f]+)(;)/i",
    "color_inverse_string",$main_css);
$main_css = preg_replace_callback(
    "/(#)([0-9a-f]+)(\s+)/i",
    "color_inverse_string",$main_css);
file_put_contents(dark_css_path, $main_css);

/* functions */
function color_inverse_string ($s)
{
    return $s[1].my_color_inverse($s[2]).$s[3];
}

function expand_color ($color)
{
    if(strlen($color) == 3)
    {
        $color = str_repeat(substr($color,0,1), 2) .
		 str_repeat(substr($color,1,1), 2) .
		 str_repeat(substr($color,2,1), 2);
    }
    return $color;
}

function color_inverse ($color)
{
    $inverse = ['0'=>'f','1'=>'e','2'=>'d','3'=>'c',
                '4'=>'b','5'=>'a','6'=>'9','7'=>'8',
                '8'=>'7','9'=>'6','a'=>'5','b'=>'4',
                'c'=>'3','d'=>'2','e'=>'1','f'=>'0',];
    $color = strtolower($color);
    $color_inverse = "";
    for($i=0; $i<strlen($color); $i++)
    {
        $c = substr($color,$i,1);
        $c = $inverse[$c];
        $color_inverse .= $c;
    }
    return $color_inverse;
}
function my_color_inverse($color)
{
    $theme = [
	'00e' => 'cf0',
	'fff' => '222',
	'e00' => 'f55',
    ];
    return @$theme[$color] ? $theme[$color] : color_inverse($color);
}
?>
