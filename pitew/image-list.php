<?php

if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; ناردنی وێنەی شاعیران &raquo; وێنەکان";
$desc = "ئەو وێنانەی کە بۆتان ناردوویین";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
	
?>

<div id="poets">
    
<div id='adrs'>
<a href="first.php">
    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
</a>
<i style='font-style:normal;'> &rsaquo; </i>
<a href="poet-image.php" style="color: rgb(128, 0, 128);">
    <i style='vertical-align:middle;' class='material-icons'>image</i>
    ناردنی وێنەی شاعیران
</a>
<i style='font-style:normal;'> &rsaquo; </i>
<div id="current-location" style="color: rgb(128, 0, 128);">
    وێنەکان
</div>

</div>
    <div>
    <section class='imglist' style='background:#eee'>یارمەتیدەر</section><section style='background:#eee' class='imglist'>نێوی شاعیر</section><section style='background:#eee' class='imglist'>وێنە</section>
    
    <?php
    
    $_list = make_list(ABSPATH."style/img/poets/new/");
    foreach($_list as $_l) {
        echo "<section class='imglist'>" . $_l['name'] . "</section><section class='imglist'>" . $_l['poet'] . "</section><section class='imglist'>" . "<a class='link' href='{$_l['uri']}'>وێنە</a></section>";
    }
    
        function make_list($_dir) {
          if(! is_dir($_dir) )
            return 0;
        
          $d = opendir($_dir);
          $_list = array();
        
          while( false !== ($entry = readdir($d))) {
            if(_unlist($entry)) {
                $uri = "/style/img/poets/new/".$entry;
                $entry = str_replace([".jpeg",".jpg",".png"], "", $entry);
                $entry = explode("_", $entry);
                $entry["poet"] = $entry[0];
                $entry["name"] = $entry[1];
                $entry["uri"] = $uri;
                array_unshift($entry, filemtime("/home/allekokc/public_html" . $uri));
                $_list[] = $entry;
            }
          }
        
          if(rsort($_list))  return $_list;
        }
        
        function _unlist($v) {
          $_Vs = array(".", "..");
          if(! in_array($v, $_Vs) ) return $v;
        }
    ?>
    </div>
    
</div>

<?php
	require_once("../script/php/footer.php");
?>