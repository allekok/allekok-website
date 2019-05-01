<?php
/*
 * Append a comment to the end of `comments.txt'
 * Input: POST[comm]
 * Output: JSON[message,[comm]]
 */
header("Content-Type:application/json;charset=UTF-8");
if(isset($_POST['comm']) and
    strlen($_POST['comm']) < 2685)
{
    include_once("colors.php");
    $comm = filter_var($_POST['comm'],
		       FILTER_SANITIZE_STRING);
    $sign = "[comment]";
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("l Y-m-d h:i:sa");
    $header = "<i class='h'>$date +++++ $ip</i>";
    $uri = "comments.txt";
    $div = "<div style='background:".
	   $colors[mt_rand(0,count($colors)-1)][2].
	   "'>";
    if(filesize($uri)>0)
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
