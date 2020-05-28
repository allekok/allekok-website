<?php
const header = "../../script/php/header.php";
const sw = "../../sw.js";

/* sw */
$content = file_get_contents(sw);
$content = preg_replace_callback(
	"/(style\/css\/main-comp\.css\?v)([0-9]+)/",
	"increase_ver", $content
);
file_put_contents(sw, $content);

/* header */
$content = file_get_contents(header);
$content = preg_replace_callback(
	"/(style\/css\/main-comp\.css\?v)([0-9]+)/",
	"increase_ver", $content
);
file_put_contents(header, $content);

function increase_ver ($I)
{
	return $I[1] . (intval($I[2])+1);
}
?>
