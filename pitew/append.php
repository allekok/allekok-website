<?php
/* 
 * Add poem to 'pitew' table
 * Input: POST: (poet,poem,contributor,poetDesc,book,poemName)
 * Output: JSON: ([state,message,contributor])
 */
require_once('../script/php/constants.php');

header("Content-Type: application/json; charset=UTF-8");
$null = json_encode(NULL);

/* Required */
$poet = @trim(filter_var($_POST['poet'], FILTER_SANITIZE_STRING));
if(!$poet) die($null);
$poem = @trim(filter_var($_POST['poem'], FILTER_SANITIZE_STRING));
if(!$poem) die($null);

/* Optional */
$contributor = @trim(filter_var($_POST['contributor'], FILTER_SANITIZE_STRING));
if(!$contributor) $contributor = "ناشناس";
$book = @trim(filter_var($_POST['book'], FILTER_SANITIZE_STRING));
$poemName = @trim(filter_var($_POST['poemName'], FILTER_SANITIZE_STRING));

$date = date("Y-m-d_h:i:sa");

/* status -> 0,-1,1 */
$status = ['status' => 0, 'url' => '', 'desc' => ''];
$status = json_encode($status);

$q = "INSERT INTO `pitew` (`id`, `contributor`, `email`, `poet`, `book`, `poem-name`, `poem-desc`, `poem`, `date`, `status`, `poetDesc`) VALUES (NULL, '$contributor', '', '$poet', '$book', '$poemName', '', '$poem', '$date', '$status', '')";
require(ABSPATH.'script/php/condb.php');

if($query) {
	$res = [
		"state" => 1,
		"message" => "<i class='color-blue' style='font-size:.55em;padding:1em .5em;display:block'
>زۆر سپاس بۆ ئێوە. ئەو شیعرە دوای پێداچوونەوە لەسەر ئاڵەکۆک دادەندرێ.</i>",
		"contributor" => [
			"name" => $contributor,
		],
	];
	
	echo(json_encode($res));
}
else
	echo($null);

mysqli_close($conn);
?>
