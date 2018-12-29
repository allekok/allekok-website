<?php

$len = filter_var($_GET["len"], FILTER_SANITIZE_NUMBER_INT);
if (! $len) $len = 120;

$pt = filter_var($_GET["pt"], FILTER_SANITIZE_NUMBER_INT);
$bk = filter_var($_GET["bk"], FILTER_SANITIZE_NUMBER_INT);
$pm = filter_var($_GET["pm"], FILTER_SANITIZE_NUMBER_INT);

if(!$pt or !$bk or !$pm)    die("");

$tbl = "tbl{$pt}_{$bk}";

// Connecting to database
$db = "index";
$q = "select hon from $tbl where id=$pm";
require("condb.php");

if(! $query) die("");

$poem = mysqli_fetch_assoc($query)["hon"];

$san_poem = filter_var($poem, FILTER_SANITIZE_STRING);
$san_poem = trim(preg_replace("/\n+\s+\n+/", "\n", $san_poem));
$san_poem = mb_substr($san_poem, 0, $len);
if(mb_strlen($poem) > $len) $san_poem .= "...";
// $san_poem = str_replace("\n", " &bull; ", $san_poem);

mysqli_close($conn);

header("Content-type: text/plain; charset=UTF-8");
echo $san_poem;

?>