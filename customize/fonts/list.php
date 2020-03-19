<?php
const _input = "fonts.txt";
const _output = "list.txt";
$fonts = array_diff(scandir("font-imgs"), [".", ".."]);
$list = [];
foreach($fonts as $o) {
    $title = substr($o, 0, -4);
    /* New Name */
    $s = trim(readline("{$title}> "));
    /* change font name */
    $fmt = "";
    if(file_exists("font-files/{$title}.ttf"))
	$fmt = "ttf";
    elseif(file_exists("font-files/{$title}.otf"))
	$fmt = "otf";
    else continue;
    if(!$s) {
	$list[] = [$title, "png", $fmt];
	continue;
    }
    exec("mv 'font-files/{$title}.{$fmt}' 'font-files/{$s}.{$fmt}'");
    /* change image name */
    exec("mv 'font-imgs/{$title}.png' 'font-imgs/{$s}.png'");
    /* list font name, img type, font type */
    $list[] = [$s, "png", $fmt];
}
file_put_contents(_output, json_encode($list));
?>
