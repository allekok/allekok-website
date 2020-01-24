<?php
const files = ["../php/footer.php", "../../sw.js"];

foreach(files as $f)
{
    $content = file_get_contents($f);
    $content = preg_replace_callback(
	"/(script\/js\/main-comp\.js\?v)([0-9]+)/",
	"increase_ver", $content
    );
    file_put_contents($f, $content);
}

function increase_ver ($I)
{
    return $I[1] . (intval($I[2])+1);
}
?>
