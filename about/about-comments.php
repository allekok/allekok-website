<?php
/* 
 * Reading comments from {$uri} file and print them. 
 * Input: GET [num,plain]
 * Output: Text, HTML
 */
$uri = "comments.txt";
if(! file_exists($uri))
    die();

$comments = file_get_contents($uri);
$comments = explode("[comment]",$comments);
$comments = array_reverse($comments);
$limit = false === filter_var(@$_GET['num'], FILTER_VALIDATE_INT) ?
	-1 : $_GET['num'];
foreach($comments as $c)
{
    if($limit == 0) break;
    if(!isset($_GET["plain"]))
	$c = str_replace("\n", "<br>", $c);
    echo $c;
    $limit--;
}
?>
