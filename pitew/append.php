<?php
// add poem to "pitew" table in "index" database
// INPUT: $_POST
// OUTPUT: JSON

// output: json
header("Content-Type: application/json; charset=UTF-8");

/* INPUT */

// Required
$poet = filter_var($_POST['poet'], FILTER_SANITIZE_STRING); // poet's name
$poem = filter_var($_POST['poem'], FILTER_SANITIZE_STRING); // poem itself

// Optional
$contributor = filter_var($_POST['contributor'], FILTER_SANITIZE_STRING); // contributor name
$poetDesc = filter_var($_POST['poetDesc'], FILTER_SANITIZE_STRING); // poet's description for new poets
$book = filter_var($_POST['book'], FILTER_SANITIZE_STRING); // book's name
$poemName = filter_var($_POST['poemName'], FILTER_SANITIZE_STRING); // poem's name

/* INPUT */

/* OUTPUT */
// ["state","message","contributor"=>["name","id"]]
/* OUTPUT */

if(empty($poet) or empty($poem)) {    
    $res = [
        "state"=>0,
        "message"=>"<i style='font-size:.5em;padding:1em .5em;display:block;background:rgba(255,0,0,.1)'>تکایە ناوی شاعیر و شێعرەکەی بنووسن.</i>"];
    die( json_encode($res) );    
}

$date = date("Y-m-d_h:i:sa");
$IP = $_SERVER['REMOTE_ADDR'];
$nfo = $date . " --- " . $IP;

// status-->0,1,-1 & if 1:url & desc
$status = ["status"=>0, "url"=>"", "desc"=>""];
$status = json_encode($status);

$db = "index";
$q = "INSERT INTO `pitew`(`contributor`, `poet`, `book`, `poem-name`, `poem`, `date`, `status`, `poetDesc`) VALUES ('$contributor', '$poet', '$book', '$poemName', '$poem', '$nfo', '$status','$poetDesc')";
require_once("../script/php/condb.php");

if($query) {
    
    $res = [
        "state"=>1,
        "message"=>"<i style='font-size:.5em;padding:1em .5em;display:block;background:#cfc'>زۆر سپاس بۆ ئێوە. ئەو شێعرە دوای پێداچوونەوە لەسەر ئاڵەکۆک دادەندرێ.</i>",
        "contributor"=> [
            "name"=>$contributor,
            "ID"=>""
        ],
    ];
    
    echo(json_encode($res));
}

mysqli_close($conn);

?>
