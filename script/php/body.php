<?php
    
$title = _TITLE;
$desc = _DESC;
$keys = _KEYS;
$t_desc = "";

if( !empty($_GET['ath']) || !empty($_GET['bk']) || !empty($_GET['id']) || !empty($_GET['q']) ) {
    
    $ath = filter_var($_GET['ath'], FILTER_SANITIZE_NUMBER_INT);
    $bk = filter_var($_GET['bk'], FILTER_SANITIZE_NUMBER_INT);
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $q = filter_var($_GET['q'], FILTER_SANITIZE_STRING);
    
    require('checkmurl.php');

} elseif($_GET['job'] === "about") {
    $about = 1;
    $color_num = 0;
    $title .= "؟"; 
    $desc = $title;
    include('header.php');
    include('about.php');
    
} elseif($_GET['job'] === "thanks") {
    $thanks = 1;
    $color_num = 0;
    $title = _TITLE . " &raquo; سپاس و پێزانین";
    $desc = $title;
    include('header.php');
    include('thanks.php');
    
} else {
    $t_desc = "<h2>"._DESC."</h2>";
    include('header.php');
    include('fbody.php');
}

?>