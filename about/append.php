<?php

header("Content-Type: application/json; charset=UTF-8");

if( !empty($_POST['comm']) && strlen($_POST['comm']) < 2685 ) {
    
    require_once("../script/php/colors.php");

    $comm = filter_var($_POST['comm'],FILTER_SANITIZE_STRING);

    $sign = "[comment]";

    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("l Y-m-d h:i:sa");
    $header = "<i class='h'>{$date} +++++ {$ip}</i>";

    $uri = "res/about.comments";

    $div = "<div style='background:{$colors[0][2]};color:#000;'>";

    if(filesize($uri)>0) {
	$comment = $sign . $div . $comm . $header . "</div>";
    } else {
	$comment = $div . $comm . $header . "</div>";
    }

    $f = fopen($uri,"a");
    fwrite($f,$comment);
    fclose($f);

    $respond = array("message"=>"ok", "comm"=>$div.$comm.$header."</div>");

    $respond = json_encode($respond);

    echo $respond;

} else {
    
    $respond = array("message"=>"no");

    $respond = json_encode($respond);

    echo $respond;
}

?>
