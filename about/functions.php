<?php
require_once("../script/php/constants.php");
require_once("../script/php/functions.php");
require_once("../script/php/kurdish-calendar.php");

const comments_file = "comments.txt";
const comment_sign = "[comment]";

function calendar_kurdish_string($date=NULL) {
	$date = calendarKurdishFromGregorian(
		$date ? $date : explode("-", date("m-d-Y")));
	$month = calendarKurdishMonth(calendarExtractMonth($date));
	$day = calendarExtractDay($date);
	$year = calendarExtractYear($date);
	$dayname = calendarKurdishDayOfWeekName($date);
	$str = "{$dayname} {$day}ی {$month}ی {$year}ی کوردی";
	return num_convert($str, "en", "ckb");
}

function print_comments($f) {
	global $comments, $last_comment_idx, $limit;
	for($i = $last_comment_idx; $i > -1 and $limit; $i--, $limit--)
		echo $f($comments[$i]);
}
?>
