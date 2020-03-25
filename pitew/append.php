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
$poet = isset($_POST['poet']) ?
	trim(filter_var($_POST['poet'], FILTER_SANITIZE_STRING)) :
	die($null);
$poem = isset($_POST['poem']) ?
	trim(filter_var($_POST['poem'], FILTER_SANITIZE_STRING)) :
	die($null);
if(empty($poet) or empty($poem))
{
    $res = [
        'state' => 0,
        'message' => "<i class='color-red' style='font-size:.5em;padding:1em .5em;display:block'>تکایە ناوی شاعیر و شێعرەکەی بنووسن.</i>"
    ];
    die( json_encode($res) );
}

/* Optional */
$contributor = isset($_POST['contributor']) ?
	       trim(filter_var($_POST['contributor'], FILTER_SANITIZE_STRING)) : '';
$book = isset($_POST['book']) ?
	trim(filter_var($_POST['book'], FILTER_SANITIZE_STRING)) : '';
$poemName = isset($_POST['poemName']) ?
	    trim(filter_var($_POST['poemName'], FILTER_SANITIZE_STRING)) : '';

$date = date("Y-m-d_h:i:sa");

/* status -> 0,-1,1 */
$status = ['status' => 0, 'url' => '', 'desc' => ''];
$status = json_encode($status);

$q = "INSERT INTO `pitew` (`id`, `contributor`, `email`, `poet`, `book`, `poem-name`, `poem-desc`, `poem`, `date`, `status`, `poetDesc`) VALUES (NULL, '$contributor', '', '$poet', '$book', '$poemName', '', '$poem', '$date', '$status', '')";
require(ABSPATH.'script/php/condb.php');

if($query)
{
    $res = [
        "state" => 1,
        "message" => "<i class='color-blue' style='font-size:.55em;padding:1em .5em;display:block'>زۆر سپاس بۆ ئێوە. ئەو شێعرە دوای پێداچوونەوە لەسەر ئاڵەکۆک دادەندرێ.</i>",
        "contributor" => [
	    "name" => $contributor,
        ],
    ];
    
    echo(json_encode($res));
}
else
{
    echo($null);
}

mysqli_close($conn);
?>
