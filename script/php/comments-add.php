<?php
// add poem's comments to database.

include_once("functions.php");

$_comment = @filter_var($_POST["comment"], FILTER_SANITIZE_STRING);
if(empty($_comment)) die();

$__address = isset($_POST["address"]) ? filter_var($_POST["address"], FILTER_SANITIZE_STRING) : die();

$address =  explode("/",$__address);

$address = array_map("explde", $address);

function explde($in) {
    return explode(":", $in);
}

$db = "index";
$tbl = "tbl{$address[0][1]}_{$address[1][1]}";
$q = "select id from {$tbl} where id={$address[2][1]}";
include("condb.php");

if($query) {
    if(! ( mysqli_num_rows($query) > 0 ) ) die();
}

$date = date("Y-m-d h:i:sa");
$_date = $date . " " . $_SERVER['REMOTE_ADDR'];

$_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);


$q = "INSERT INTO comments(address, date, name, comment) VALUES('$__address', '$_date', '$_name', '$_comment')";
$query = mysqli_query($conn, $q);

if($query) {
    
    $date = num_convert($date, "en", "ckb");
    $date = str_replace(["am","pm"], [" بەیانی "," پاش‌نیوەڕۆ "], $date);
    
    if($_name == "") $_name = "ناشناس";
    
    $res = [
        "message"=>"",
        "status"=>1,
        "name"=>$_name,
        "comment"=>$_comment,
        "date"=>$date,
    ];
    
    echo json_encode($res);
}

mysqli_close($conn);

?>
