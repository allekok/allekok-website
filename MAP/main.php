<?php
require("library.php");

$output = fopen("MAP.org","w");
fwrite($output,"#+TITLE: Functions\n#+AUTHOR: MAP\n\n");

$php_files = list_php_files("..");
foreach($php_files as $file)
{
    $funcs = functions($file);
    if(empty($funcs)) continue;
    
    fwrite($output, "/[[".$file."][".
		    basename($file)." (".
		    count($funcs).")]]/\n");
    foreach($funcs as $e)
    {
	fwrite($output, "- $e\n");
    }
    fwrite($output, "\n");
}
fclose($output);
?>
