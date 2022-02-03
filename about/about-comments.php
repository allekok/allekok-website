<?php
/* 
 * Reading comments from {comments_file} file and print them.
 * Input: GET[num, plain]
 * Output: Text, HTML
 */
require("functions.php");

if(!file_exists(comments_file))
	die();
$comments = file_get_contents(comments_file);
$comments = explode("[comment]", $comments);
$last_comment_idx = count($comments) - 1;

$limit = filter_var(@$_GET["num"], FILTER_VALIDATE_INT) === false ?
	-1 :
	 $_GET["num"];
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
