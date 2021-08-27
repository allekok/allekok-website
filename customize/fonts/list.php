<?php
const _output = "list.txt";
$fonts = array_diff(scandir("font-imgs"), [".", ".."]);
$list = [];
foreach($fonts as $o) {
	$title = substr($o, 0, -4);
	$list[] = [$title, "jpg", "woff2"];
}
file_put_contents(_output, json_encode($list));
?>
