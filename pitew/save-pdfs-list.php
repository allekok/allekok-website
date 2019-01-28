<?php
$base = "https://github.com/allekok/diwan/raw/master/";
$list_uri = $base . "list.txt?" . time();
$list = @file_get_contents($list_uri);
file_put_contents("pdfs.txt", $list);
echo $list_uri;
?>