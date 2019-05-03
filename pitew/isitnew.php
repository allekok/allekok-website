<?php
include_once("../script/php/functions.php");
header("Content-Type: application/json; charset=UTF-8");
$new = 1;
$_id = $img = 0;

if(isset($_GET['poet'])) {
    
    $_poet = trim(filter_var($_GET['poet'], FILTER_SANITIZE_STRING));
    
    $db = "index";
    $q = "select id, name, takh, profname from auth";
    require("../script/php/condb.php");
    
    while($res = mysqli_fetch_assoc($query)) {

        if( $res['takh'] == $_poet or
	    $res['profname'] == $_poet) {
            
            $_id = $res['id'];
            $new=0;

            break;
        }
    }
    
    mysqli_close($conn);
} else {
    $new=0;
}

if(file_exists("../style/img/poets/profile/profile_{$_id}.jpg")) {
    $img = $_id;
}

$_res = [
    "new"=>$new,
    "id"=>$_id,
    "img"=>$img,
];

echo json_encode($_res);
?>
