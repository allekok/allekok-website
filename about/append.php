<?php
/*
 * Append a comment to the end of {comments_file}
 * Input: POST[comm]
 * Output: JSON[message, comm]
 */
require_once("../script/php/functions.php");
require_once("functions.php");

$comment = isset($_POST["comm"]) ?
	   trim(filter_var($_POST["comm"], FILTER_SANITIZE_STRING)) :
	   FALSE;

if($comment and mb_strlen($comment) < 2685) {
	$time = num_convert(date("H:i:s"), "en", "ckb");
	$date = calendar_kurdish_string();
	$date = "<i class='h'>{$date} {$time} بە کاتی مەهاباد</i>";
	$div = "<div>{$comment}{$date}</div>";	
	$com = file_exists(comments_file) and filesize(comments_file) > 0 ?
	       comment_sign . $div :
	       $div;
	
	$f = fopen(comments_file, "a");
	fwrite($f, $com);
	fclose($f);
	
	$respond = ["message" => "ok", "comm" => $div];
}
else {
	$respond = ["message" => "no"];
}

header("Content-Type:application/json; Charset=UTF-8");
echo json_encode($respond);
?>
