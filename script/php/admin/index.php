<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; مدیر";
$desc = "مدیر";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');
?>

<style>
 .line {
     direction:ltr;
     text-align:left;
     font-family:'kurd',mono;
     font-size:.8em;
 }
 .line a {
     padding:.5em;
     display:block;
 }
</style>

<div id="poets">

    <?php

    $files = scandir("./");
    $NOT = [".",".."];
    foreach($files as $f) {
	if(!in_array($f, $NOT))
	    echo "<p class='line'><a class='link' href='{$f}'>{$f}</a></p>";
    }

    ?>

</div>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
