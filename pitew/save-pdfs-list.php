<?php
$base = "https://allekok.github.io/diwan/";
$list_uri = $base . "list.txt?" . time();
$list = @file_get_contents($list_uri);
file_put_contents("pdfs.txt", $list);
echo $list_uri;
?>
