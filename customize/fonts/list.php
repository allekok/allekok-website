<?php
const _input = "fonts.txt";
const _output = "list.txt";
$fonts = json_decode(file_get_contents(_input), true);
$list = [];
foreach($fonts as $k=>$o) {
    /* New Name */
    $s = trim(readline("{$o["title"]}> "));
    if(!$s) continue;
    /* change font name */
    $fmt = "";
    if(file_exists("font-files/{$o["title"]}.ttf"))
	$fmt = "ttf";
    elseif(file_exists("font-files/{$o["title"]}.otf"))
	$fmt = "otf";
    else continue;
    exec("mv 'font-files/{$o["title"]}.{$fmt}' 'font-files/{$s}.{$fmt}'");
    /* change image name */
    exec("mv 'font-imgs/{$o["title"]}.png' 'font-imgs/{$s}.png'");
    /* list font name, img type, font type */
    $list[] = [$s, "png", $fmt];
}
file_put_contents(_output, json_encode($list));
?>
