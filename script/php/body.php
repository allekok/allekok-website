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
    $bk = empty($_GET["bk"]) ? null : filter_var($_GET['bk'], FILTER_SANITIZE_NUMBER_INT);
    $id = empty($_GET["id"]) ? null : filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $q = empty($_GET["q"]) ? null : filter_var($_GET['q'], FILTER_SANITIZE_STRING);
    
    require('checkmurl.php');

} else {
    // https://allekok.com/
    
    $t_desc = "<h2>"._DESC."</h2>";
    include('header.php');
    include('fbody.php');
}

?>
