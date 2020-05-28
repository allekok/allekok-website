<?php
const comments_file = "comments.txt";
const comment_sign = "[comment]";

function calendar_kurdish_string ($date=NULL) {
	if(!$date)
		$date = calendarKurdishFromGregorian(
			explode("-", date("m-d-Y")));
	$year = calendarExtractYear($date);
	$month = calendarKurdishMonth(
		calendarExtractMonth($date));
	$day = calendarExtractDay($date);

	return "{$day}ی {$month}ی {$year}ی کوردی";
}
?>
