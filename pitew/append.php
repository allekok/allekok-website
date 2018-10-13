<?php

header("Content-Type: application/json; charset=UTF-8");

$contributor = filter_var($_POST['contributor'], FILTER_SANITIZE_STRING);
$poet = filter_var($_POST['poet'], FILTER_SANITIZE_STRING);
$poetDesc = filter_var($_POST['poetDesc'], FILTER_SANITIZE_STRING);
$book = filter_var($_POST['book'], FILTER_SANITIZE_STRING);
$poemName = filter_var($_POST['poemName'], FILTER_SANITIZE_STRING);
$poem = filter_var($_POST['poem'], FILTER_SANITIZE_STRING);

if(empty($poet) || empty($poem)) {
    
    // state, message, contributor['name'],['ID']
    $res = array(
        "state"=>0,
        "message"=>"<i class='nr'>تکایە ناوی شاعیر و شێعرەکەی بنووسن.</i>");
        
    echo( json_encode($res) );
} else {
    
    $date = date("Y-m-d_h:i:sa");
    $IP = $_SERVER['REMOTE_ADDR'];
    $nfo = $date . " --- " . $IP;
    
    // status-->0,1,-1 & if 1:url & desc
    $status = array("status"=>0, "url"=>"", "desc"=>"");
    $status = json_encode($status);
    
    $db = "index";
    $q = "INSERT INTO `pitew`(`contributor`, `poet`, `book`, `poem-name`, `poem`, `date`, `status`, `poetDesc`) VALUES ('$contributor', '$poet', '$book', '$poemName', '$poem', '$nfo', '$status','$poetDesc')";
    require_once("../script/php/condb.php");
    
    if($query) {
        
        $res = array(
            "state"=>1,
            "message"=>"<i class='ng'>زۆر سپاس بۆ ئێوە. ئەو شێعرە دوای پێداچوونەوە لەسەر ئاڵەکۆک دادەندرێ.</i>",
            "contributor"=> array(
                "name"=>$contributor,
                "ID"=>""
                )
            );
        
        echo(json_encode($res));
        
    }
}

?>