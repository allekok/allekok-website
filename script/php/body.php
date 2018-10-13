<?php
    
$title = _TITLE;
$desc = _DESC;
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";

if( !empty($_GET['ath']) || !empty($_GET['bk']) || !empty($_GET['id']) || !empty($_GET['q']) ) {
    
    $ath = filter_var($_GET['ath'], FILTER_SANITIZE_NUMBER_INT);
    $bk = filter_var($_GET['bk'], FILTER_SANITIZE_NUMBER_INT);
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $q = filter_var($_GET['q'], FILTER_SANITIZE_STRING);
    
    require('checkmurl.php');

} elseif($_REQUEST['job'] === "about") {
  $t_class = "ltitle";
  $about = 1;
  $color_num = 0;
  $title .= "؟"; 
  $desc = $title;
  include('header.php');
  include('about.php');
    
} elseif($_REQUEST['job'] === "thanks") {
  $t_class = "ltitle";
  $thanks = 1;
  $color_num = 0;
  $title = _TITLE . " &raquo; سپاس و پێزانین";
  $desc = $title;
  include('header.php');
  include('thanks.php');
    
} else {
    $t_desc = "<h2>"._DESC."</h2>";
    $t_class = "ftitle";
    include('header.php');
    include('fbody.php');
}
