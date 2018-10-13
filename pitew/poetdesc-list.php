<?php

if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی زانیاری سەبارەت بە شاعیران &raquo; زانیاریەکان";
$desc = "ئەو زانیاریانەی کە بۆتان نووسیوین";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
	
?>

<div id="poets">
    
<p id='adrs'>
    <?php
        $__allekok_url = _SITE;
    ?>
<a href="<?php echo $__allekok_url; ?>" style='background-image:url(/style/img/allekok.png);background-repeat:no-repeat;background-position: 3.7em 0.1em;padding-right: 1.8em;background-size: 1.6em;'>ئاڵەکۆک</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>

<a href="first.php">
    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>
<a href="edit-poet.php">
    <i style='vertical-align:middle;' class='material-icons'>person</i>
    نووسینی زانیاری سەبارەت بە شاعیران
</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>
<i style='vertical-align:middle;' class='material-icons'></i>
    زانیاریەکان
</p>

    <h1 style="background: rgba(154, 205, 50, 0.05);color: rgb(154, 205, 50);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
        ئەو زانیاریانەی کە نووسیوتانە
    </h1>
    <br>
    
    <section class='eplist' style='background:#eee'>یارمەتیدەر</section><section style='background:#eee' class='eplist'>شاعیر</section><section class='eplist' style='background:#eee;text-align: unset;text-indent: unset;padding: .5em 0;'>زانیاریەکان</section>
    
    <?php
    
    $_list = make_list(ABSPATH."pitew/res/");
    if(!empty($_list)) {
        foreach($_list as $_l) {
            echo "<section class='eplist'>" . $_l['name'] . "</section><section class='eplist'>" . $_l['poet'] . "</section><section class='eplist'>" . "{$_l['content']}</section>";
        }
    } else {
        echo "<span style='color:#999;font-size:1em;display:block'>&bull;</span>";
    }
    
        function make_list($_dir) {
          if(! is_dir($_dir) )
            return 0;
        
          $d = opendir($_dir);
          $_list = array();
        
          while( false !== ($entry = readdir($d))) {
            if(_unlist($entry)) {
                $uri = "/pitew/res/".$entry;
                $uri2 = ABSPATH."pitew/res/".$entry;
                $entry = str_replace(".txt", "", $entry);
                $entry = explode("_", $entry);
                $entry["name"] = $entry[0];
                $entry["poet"] = $entry[1];
                $entry["uri"] = $uri;
                $entry["content"] = str_replace(["end","\n"], ["","<br>"], file_get_contents($uri2));
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

<?php
	require_once("../script/php/footer.php");
?>