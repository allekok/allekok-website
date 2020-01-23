<?php
/*
 * Append a comment to the end of {uri}
 * Input: POST:(comm)
 * Output: JSON:(message,[comm])
 */
require_once("../script/php/constants.php");
require_once(ABSPATH . "script/php/functions.php");

header("Content-Type:application/json;Charset=UTF-8");

if(isset($_POST['comm']) and
    strlen($_POST['comm']) < 2685)
{
    $comm = filter_var($_POST['comm'],
		       FILTER_SANITIZE_STRING);
    
    require("functions.php");
    
    $color = color_random();
    $date = date("l Y-m-d h:i:sa");
    $date = str_replace(
	['Saturday', 'Sunday', 'Monday', 'Tuesday',
	 'Wednesday', 'Thursday', 'Friday', 'am', 'pm'],
	['شەممە', 'یەک‌شەممە', 'دووشەممە', 'سێ‌شەممە',
	 'چوارشەممە', 'پێنج‌شەممە', 'هەینی', ' بەیانی', ' پاش‌نیوەڕۆ'],
	$date
    );
    $date = num_convert($date, 'en', 'ckb');
    $header = "<i class='h'>{$date}</i>";
    $div = "<div style='color:{$color['fore']};background:{$color['back']}'>";
    
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
{
    $respond = ["message" => "no"];
}

$respond = json_encode($respond);
echo $respond;
?>
