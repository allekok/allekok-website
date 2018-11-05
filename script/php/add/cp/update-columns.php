<?php

$p = $_GET['p'] or die("p is null;");
$b = $_GET['b'] or die("b is null;");
$lang = $_GET['lang'] or die("lang is null;");

$tbl = "tbl{$p}_{$b}";

$db = "index";
$q = "select id, lang from {$tbl}";
require("../../condb.php");

while($pm = mysqli_fetch_assoc($query)) {
    
    $q = "UPDATE `{$tbl}` SET `lang`='{$lang}' WHERE `id`={$pm['id']}";
    if(mysqli_query($conn, $q)) {
        echo "{$pm['id']} => true<br>";
    } else {
        die( "false" );
    }
}

mysqli_close($conn);

?>