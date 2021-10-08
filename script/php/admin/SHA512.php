<?php
$input = "";
if(isset($argv[1]))
	$input = $argv[1];
elseif(isset($_REQUEST["input"]))
	$input = $_REQUEST["input"];

header("Content-type: text/plain; charset=UTF-8");
echo hash("SHA512", $input);
?>
