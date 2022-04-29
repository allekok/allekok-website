<?php
/*
 * Input: REQUEST[pt]
 * Output: Base 64 plain text
 */
require_once("../../script/php/constants.php");

header("Content-type:text/plain; charset=UTF-8");

$pt = isset($_REQUEST["pt"]) ?
      filter_var($_REQUEST["pt"], FILTER_SANITIZE_STRING) :
      die();

$img = "../../style/img/poets/profile/profile_{$pt}.jpg";
if(!file_exists($img))
	$img = "../../style/img/poets/profile/profile_0.jpg";

echo base64_encode(file_get_contents($img));
?>
