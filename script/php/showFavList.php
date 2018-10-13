<?php

require("functions.php");
require_once("colors.php");

$db = "index";
$q = "select id,takh,bks from auth";

require("condb.php");

$_poets = array();
while($res = mysqli_fetch_assoc($query)) {
    $res['bks'] = explode(",", $res['bks']);
    $_poets[] = $res;
}

$_reses = array();
$_lks = array();
$lmt = 0;
$lmt_end = filter_var($_GET['lmt'], FILTER_VALIDATE_INT) ? $_GET['lmt'] : 60;

    
foreach($_poets as $_p) {
    
    for($_b=1; $_b<=count($_p['bks']); $_b++) {
        $_tbl = "tbl{$_p['id']}_{$_b}";
        
        $q = "select id,name,likes from {$_tbl} where likes>3 order by likes";
        $query = mysqli_query($conn, $q);
        
        while(($res = mysqli_fetch_assoc($query))) {
            $res['poet'] = $_p;
            unset($res['poet']['bks']);
            $res['book']['id'] = "$_b";
            $res['book']['name'] = $_p['bks'][$_b-1];
            unset($res['hon']);
            $res['kulikes'] = num_convert($res['likes'],"en","ckb");
            // for sort
            array_unshift($res, $res['likes'], $res['poet']['takh']);
            
            unset($res['likes']);
            
            $_reses0[] = $res;
            
        }
    }
}

rsort($_reses0);

foreach($_reses0 as $_k => $_r) {
    if( $lmt == $lmt_end )   break 1;
        array_shift($_r);
        array_shift($_r);
        $_reses[$_k] = $_r;
        
        $lmt++;
}

mysqli_close($conn);

header("Content-Type: application/json; charset=UTF-8");

echo(json_encode($_reses));




?>