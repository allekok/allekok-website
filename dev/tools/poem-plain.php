<?php

require_once("../../script/php/constants.php");
require(ABSPATH . "script/php/functions.php");

$null = json_encode(null);

$_pt = filter_var($_REQUEST['poet'], FILTER_SANITIZE_STRING);

if(empty($_pt)) die($null);

$db = "index";

$w = filter_var($_pt, FILTER_VALIDATE_INT) ? "id={$_pt}" : "takh='{$_pt}' or profname='{$_pt}' or name='{$_pt}'";
$q = "SELECT * FROM auth WHERE {$w}";

require(ABSPATH . "script/php/condb.php");

if(mysqli_num_rows($query) !== 1)    die($null);

$_bk = filter_var($_REQUEST['book'], FILTER_SANITIZE_STRING);

if(empty($_bk)) die($null);

$poet = mysqli_fetch_assoc($query);

$poet['bks'] = explode(",", $poet['bks']);

$_pm = filter_var($_REQUEST['poem'], FILTER_SANITIZE_STRING);
if(empty($_pm)) die($null);

$_pms = explode(",", $_pm);
$poems = [];

foreach($_pms as $_pm) {
    
    if(filter_var($_bk, FILTER_VALIDATE_INT)) {
        
	
        if($_bk > count($poet['bks']) )    die($null);
        
        $_tbl = "tbl{$poet['id']}_{$_bk}";
        
        $w = filter_var($_pm, FILTER_VALIDATE_INT) ? " WHERE id={$_pm}" : " WHERE name='{$_pm}'";
        if($_pm == "all") {
            $w = "";
        }
        $q = "SELECT * from {$_tbl}{$w} order by id";
        $query = mysqli_query($conn, $q);

        while($r = mysqli_fetch_assoc($query)) {
            $poems[] = $r;
        }
        
        
    } else {
        
        $_bk = array_search($_bk, $poet['bks']);
        
        if($_bk === false)  die($null);
        
        $_bk++;
        
        $_tbl = "tbl{$poet['id']}_{$_bk}";
        
        $w = filter_var($_pm, FILTER_VALIDATE_INT) ? " WHERE id={$_pm}" : " WHERE name='{$_pm}'";
        if($_pm == "all") {
            $w = "";
        }
        $q = "SELECT * from {$_tbl}{$w} order by id";
        $query = mysqli_query($conn, $q);

        while($r = mysqli_fetch_assoc($query)) {
            $poems[] = $r;
        }
        
    }
}

if(empty($poems)) die($null);
if(! isset($_REQUEST['html'])) {
    foreach($poems as $k => $p) {
        $p['hon'] = trim(filter_var($p['hon'], FILTER_SANITIZE_STRING));
        $poems[$k] = $p;
    }
}

$reses_str = "شاعیر: {$poet['takh']}\nکتێب: {$poet['bks'][$_bk-1]}\n";
foreach($poems as $k => $p) {
    $reses_str .= "سەرناو: {$p["name"]}";
    if(trim($p["hdesc"]))
	$reses_str .= "\nلەبارەی شێعر: \n{$p["hdesc"]}";
    $reses_str .= "\n\n{$p["hon"]}\n++++++++++++++++++++++\n";
}

$ll = mb_strlen($reses_str);

header("Content-type:plain/text; charset=UTF-8");
header("x-con-len:{$ll}");

    echo $reses_str;

    mysqli_close($conn);

?>
