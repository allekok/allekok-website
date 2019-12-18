<?php
/*
 * Append a comment to the end of `comments.txt'
 * Input: POST:(comm)
 * Output: JSON:(message,[comm])
 */
require_once('../script/php/constants.php');
require(ABSPATH.'script/php/functions.php');
header("Content-Type:application/json;charset=UTF-8");
if(isset($_POST['comm']) and
    strlen($_POST['comm']) < 2685)
{
    require(ABSPATH.'about/color.php');
    $comm = filter_var($_POST['comm'],
		       FILTER_SANITIZE_STRING);
    $sign = "[comment]";
    $date = date("l Y-m-d h:i:sa");
    $date = str_replace(['Saturday',
			 'Sunday',
			 'Monday',
			 'Tuesday',
			 'Wednesday',
			 'Thursday',
			 'Friday'],
			['شەممە',
			 'یەک‌شەممە',
			 'دووشەممە',
			 'سێ‌شەممە',
			 'چوارشەممە',
			 'پێنج‌شەممە',
			 'هەینی'], $date);
    $date = str_replace(['am','pm'],
			[' بەیانی',
			 ' پاش‌نیوەڕۆ'], $date);
    $date = num_convert($date,'en','ckb');
    $header = "<i class='h'>$date</i>";
    $color = color_random();
    $uri = "comments.txt";
    $div = "<div style='color:{$color['fore']};background:{$color['back']}'>";
    if(file_exists($uri) and @filesize($uri)>0)
	$comment = $sign.$div.$comm.$header."</div>";
    else
	$comment = $div.$comm.$header."</div>";
    
    $f = fopen($uri,"a");
    fwrite($f,$comment);
    fclose($f);
    
    $respond = ["message"=>"ok",
		"comm"=>$div.$comm.$header."</div>"];
}
else
{
    $respond = ["message"=>"no"];
}

$respond = json_encode($respond);
echo $respond;
?>
