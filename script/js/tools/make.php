<?php
require_once("constants.php");

const input = main;
const output = main_comp;

file_put_contents(output,
		  file_get_contents(js_constants) .
		  "\n" . file_get_contents(input));
echo "`(constants.js + main.js)` Done.\n";

exec("php compress.php");
echo "`compress` Done.\n";

exec("php update_ver.php");
echo "`update_ver` Done.\n";
?>
