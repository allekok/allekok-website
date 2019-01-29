<?php

// default values
$title = _TITLE; // page title used in <title></title>
$desc = _DESC; // page description used in <meta name="description"> and <meta property="og:title">
$keys = _KEYS; // page keywords used in <meta name="keywords">
$t_desc = ""; // page description section used in "header h2" (only for index page till now)

if( !empty($_GET['ath']) or !empty($_GET['bk']) or !empty($_GET['id']) or !empty($_GET['q']) ) {
    // https://allekok.com/poet:{$ath}/book:{$bk}/poem:{$id}
    // https://allekok.com/?ath={$ath}&bk={$bk}&id={$id}
    // https://allekok.com/?q={$q}
    
    $ath = filter_var($_GET['ath'], FILTER_SANITIZE_NUMBER_INT);
    $bk = filter_var($_GET['bk'], FILTER_SANITIZE_NUMBER_INT);
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $q = filter_var($_GET['q'], FILTER_SANITIZE_STRING);
    
    require('checkmurl.php');

} elseif($_GET['job'] === "about") {
    // https://allekok.com/about
    
    $color_num = 0;
    $title .= "؟"; 
    $desc = $title;
    include('header.php');
    include('about.php');
    
} elseif($_GET['job'] === "thanks") {
    // https://allekok.com/thanks
    
    $color_num = 0;
    $title = _TITLE . " &raquo; سپاس و پێزانین";
    $desc = $title;
    include('header.php');
    include('thanks.php');
    
} else {
    // https://allekok.com/
    
    $t_desc = "<h2>"._DESC."</h2>";
    include('header.php');
    include('fbody.php');
}

?>
