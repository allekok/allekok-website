<?php

require_once("../../script/php/constants.php");
require("../../script/php/functions.php");

header("Content-type:application/json; charset=UTF-8");

$null = json_encode(null);

$_pt = filter_var($_REQUEST['poet'], FILTER_SANITIZE_STRING);

if(empty($_pt)) die($null);

$db = "index";

$w = filter_var($_pt, FILTER_VALIDATE_INT) ? "id={$_pt}" : "takh='{$_pt}' or profname='{$_pt}' or name='{$_pt}'";
$q = "SELECT * FROM auth WHERE {$w}";

require("../../script/php/condb.php");

if(mysqli_num_rows($query) !== 1)    die($null);

$_bk = filter_var($_REQUEST['book'], FILTER_SANITIZE_STRING);

if(empty($_bk)) die($null);

$poet = mysqli_fetch_assoc($query);

$poet['bks'] = explode(",", $poet['bks']);
$poet['bksdesc'] = explode(",", $poet['bksdesc']);

if(filter_var($_bk, FILTER_VALIDATE_INT)) {
    

    if($_bk > count($poet['bks']) )    die($null);
    
    $_tbl = "tbl{$poet['id']}_{$_bk}";
    
    $q = "SELECT name from {$_tbl}";
    $query = mysqli_query($conn, $q);
    $poems = [];
    
    while($r = mysqli_fetch_assoc($query)) {
        $poems[] = $r['name'];
    }
    
    $res = [
        "poetID" => $poet['id'],
        "poet" => $poet['takh'],
        "book" => $poet['bks'][$_bk-1],
        "bookID" => $_bk,
        "desc" => $poet['bksdesc'][$_bk-1],
        "poems" => $poems,
        ];
        
    echo json_encode($res);
    
} else {
    
    $_bk = array_search($_bk, $poet['bks']);
    
    if($_bk === false)  die($null);
    
    $_bk++;
    
    $_tbl = "tbl{$poet['id']}_{$_bk}";
    
    $q = "SELECT name from {$_tbl}";
    $query = mysqli_query($conn, $q);
    $poems = [];
    
    while($r = mysqli_fetch_assoc($query)) {
        $poems[] = $r['name'];
    }
    
    $res = [
        "poetID" => $poet['id'],
        "poet" => $poet['takh'],
        "book" => $poet['bks'][$_bk-1],
        "bookID" => $_bk,
        "desc" => $poet['bksdesc'][$_bk-1],
        "poems" => $poems,
        ];
        
    echo json_encode($res);
    
}

mysqli_close($conn);

?>