<?php
/*
 * Append a comment to the end of {uri}
 * Input: POST:(comm)
 * Output: JSON:(message,[comm])
 */
require_once("../script/php/constants.php");
require_once(ABSPATH . "script/php/functions.php");
require_once("functions.php");

header("Content-Type:application/json;Charset=UTF-8");

$comm = @trim(filter_var($_POST['comm'],
			 FILTER_SANITIZE_STRING));

if($comm and mb_strlen($comm) < 2685) {	
	$date = calendar_kurdish_string();
	$dayname = date("l");
	$dayname = str_replace(
		["Saturday", "Sunday", "Monday", "Tuesday",
		 "Wednesday", "Thursday", "Friday"],
		["شەممە", "یەک‌شەممە", "دووشەممە", "سێ‌شەممە",
		 "چوارشەممە", "پێنج‌شەممە", "هەینی"],
		$dayname);
	$time = num_convert(date("h:i:sa"), "en", "ckb");
	$time = str_replace(
		["am", "pm"],
		[" بەیانی", " پاش‌نیوەڕۆ"],
		$time);
	$date = "{$dayname} {$date} {$time} بە کاتی مەهاباد";
	$header = "<i class='h'>{$date}</i>";
	$div = "<div>";
	
	if(file_exists(comments_file) and filesize(comments_file) > 0)
		$comment = comment_sign . $div . $comm . $header . "</div>";
	else
		$comment = $div . $comm . $header . "</div>";
	
	$f = fopen(comments_file, "a");
	fwrite($f, $comment);
	fclose($f);
	
	$respond = ["message" => "ok",
		    "comm" => $div . $comm . $header . "</div>"];
}
else
	$respond = ["message" => "no"];

$respond = json_encode($respond);
echo $respond;
?>
