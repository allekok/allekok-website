<?php
/* print a summary of length $_GET["len"] of any poem. */

header("Content-type: text/plain; charset=UTF-8");

$pt = @intval($_GET["pt"]);
$bk = @intval($_GET["bk"]);
$pm = @intval($_GET["pm"]);
if(! ($pt and $bk and $pm) ) die();

$len = @intval($_GET['len']);
if (! $len) $len = 120;

$tbl = "tbl{$pt}_{$bk}";

/* Connecting to database */
$q = "select hon from `$tbl` where id=$pm";
require('condb.php');

if(! $query) die();
$poem = mysqli_fetch_assoc($query)['hon'];

$san_poem = filter_var($poem, FILTER_SANITIZE_STRING);
$san_poem = trim(preg_replace("/\n+\s+\n+/u", "\n", $san_poem));
$san_poem = mb_substr($san_poem, 0, $len);
if(mb_strlen($poem) > $len) $san_poem .= '...';

mysqli_close($conn);

echo $san_poem;
?>
