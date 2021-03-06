<?php
/*
 * Input: GET:(pt)
 * Output: Base-64 Plain Text
 */
require_once('../../script/php/constants.php');

$pt = isset($_GET['pt']) ?
      filter_var($_GET['pt'], FILTER_SANITIZE_STRING) :
      die();

$img = ABSPATH."style/img/poets/profile/profile_$pt.jpg";
if(! file_exists($img))
	$img = ABSPATH.'style/img/poets/profile/profile_0.jpg';

header('Content-type:text/plain; Charset=UTF-8');
echo base64_encode(file_get_contents($img));
?>
