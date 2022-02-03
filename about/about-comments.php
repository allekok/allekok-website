<?php
/* 
 * Reading comments from {comments_file} file and print them.
 * Input: GET[num, plain]
 * Output: Text, HTML
 */
require_once("functions.php");

if(!file_exists(comments_file))
	die();
$comments = file_get_contents(comments_file);
$comments = explode("[comment]", $comments);
$last_comment_idx = count($comments) - 1;

$limit = isset($_GET["num"]) ? intval($_GET["num"]) : -1;
$plain = isset($_GET["plain"]);

if($plain) {
	header("Content-type: text/plain; Charset=UTF-8");
	print_comments(function($c) {
		return $c;
	});
}
else {
	header("Content-type: text/html; Charset=UTF-8");
	print_comments(function($c) {
		return str_replace("\n", "<br>", $c);
	});
}
?>
