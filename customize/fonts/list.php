<?php
const _output = "list.txt";
$fonts = array_diff(scandir("font-imgs"), [".", ".."]);
$list = [];
foreach($fonts as $f) {
	$fname = substr($f, 0, -4);
	$name = file_get_contents("font-names/{$fname}.txt");
	$list[$fname] = [$name, $fname, "jpg", "woff2"];
}
file_put_contents(_output, json_encode($list));
?>
