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
    
<div id='adrs'>
<a href="first.php">
    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
</a>
<i style='font-style:normal;'> &rsaquo; </i>
<a href="edit-poet.php">
    <i style='vertical-align:middle;' class='material-icons'>person</i>
    نووسینی زانیاری سەبارەت بە شاعیران
</a>
<i style='font-style:normal;'> &rsaquo; </i>
<div id="current-location">
    زانیاریەکان
</div>

</div>

<?php
    
    $_name = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
    $_poet = filter_var($_GET['poet'], FILTER_SANITIZE_STRING);
    ?>
    
    <style>
        .epld {
            color:#444;
            padding:1em;
            border:0;
            font-size:.6em;
            text-align:right;
        }
        .epld-title {
            background:#eee;
            padding:1em;
        }
        .epld-body {
            padding:1em;
            background:#fafafa;
            text-indent:1em;
            border:1px solid #eee;
        }
        #num_pdl {
            color:#555;
            font-size:.55em;
        }
    </style>
    
    <div>
    
    <?php
    
    $_list = make_list(ABSPATH."pitew/res/");
    $_count = 0; $_html = "";
    if(!empty($_list)) {
        foreach($_list as $_l) {
            if(! empty($_name) and $_name !== $_l['name'])  continue;
            if(! empty($_poet) and $_poet !== $_l['poet']) {
                $_count++;
                continue;
            }
            $_html .= "<div class='epld'><section class='epld-title'>&laquo;" . num_convert($_l['name'],"en","ckb") . "&raquo; سەبارەت بە &laquo;" . $_l['poet'] . "&raquo; نووسیویەتی: </section><section class='epld-body'>" . "{$_l['content']}</section></div>";
            $_count++;
        }
    } else {
        echo "<span style='color:#999;font-size:1em;display:block'>&bull;</span>";
    }
    
    if(!($_name and $_poet)) {
        $n_str = empty($_name) ? "" : "ی &laquo;$_name&raquo;";
        echo "<div id='num_pdl'>ئەژماری نووسراوەکان" . num_convert($n_str, "en", "ckb") . ": " . num_convert($_count, "en", "ckb") . "</div>";
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
    
    <div style='text-align:right;margin:.3em 0'>
        <?php if($_name) { ?>
        <a class='button' href="/pitew/poetdesc-list.php">
            تەواوی ئەو زانیاریانەی نووسراون
        </a>
        <?php } ?>
    </div>
    
    <div>
        <?php
            if(empty($_html)) {
                echo "<span style='color:#999;font-size:1em;display:block'>&bull;</span>";
            } else {
                echo $_html;
            }
        ?>
    </div>
    
    </div>
</div>

<?php
	require_once("../script/php/footer.php");
?>