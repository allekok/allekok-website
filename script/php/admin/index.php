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
     font-family:'kurd',monospace;
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
    rsort($files);
    $NOT = [
	".","..","IP-blacklist.php","IP-blacklist-sample.php",
	"SHA512.php","capture","comment-block.php","comment-read.php",
	"index.php","link-ganjoor.php","login.php","password.php",
	"password-sample.php","session.php","error_log",".htaccess"
    ];
    foreach($files as $f)
    {
	if(!in_array($f, $NOT))
	    echo "<p class='line'><a class='link' href='$f'>&rsaquo; ".
		 substr($f,0,-4)."</a></p>";
    }
    ?>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
