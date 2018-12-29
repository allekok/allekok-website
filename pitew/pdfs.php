<?php

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$ptw = 1;
$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; داگرتنی دیوانی شاعیران";
$desc = "داگرتنی دیوانی شاعیران بە فۆڕمەتی PDF";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
?>

<div id="poets" style="max-width:1000px">
    
    <div id='adrs'>
        <a href="first.php">
            <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
        </a>
        <i style='font-style:normal;'> &rsaquo; </i>
        <a href="index.php">
            <i style='vertical-align:middle;' class='material-icons'>note_add</i>
            نووسینی شێعر
        </a>
        <i style='font-style:normal;'> &rsaquo; </i>
        <div id="current-location" style="color: #555;">
        <i style='vertical-align:middle;' class='material-icons'>cloud_download</i>
            داگرتنی دیوانی شاعیران
        </div>
    </div>
    <style>
        .eee {
            text-align:right;
            font-size:.6em;
            padding:.2em 1em;
        }
        .eee a {
            color:#00e;
        }
        .eee i {
            font-size:.65em;
            color:#555;
            font-family:monospace;
        }
        .eee span {
            color:#555;
            font-size:.85;
        }
    </style>
    
    <main id="main">
        <?php
            $base = "https://github.com/allekok/diwan/raw/master/";
            $list_uri = $base . "list.txt";
            $list = @file_get_contents($list_uri);
            
            $list = explode("\n\n", $list);
            $list[] = "فەقێ تەیران - دیوان\t\t277.9MB";
            sort($list);
            
            for($i = 0; $i<count($list); $i++) {
                $num = num_convert($i+1, "en", "ckb");
                $list[$i] = explode("\t\t", $list[$i]);
                $name = str_replace(".pdf", "", strtolower($list[$i][0]));
                if($name === "فەقێ تەیران - دیوان") {
                    echo "<div class='eee'><span>$num.</span> <a href='https://archive.org/download/sarabia_20160323/%D8%AF%DB%8C%D9%88%D8%A7%D9%86%DB%8C%20%D9%81%DB%95%D9%82%DB%8E%20%D8%AA%DB%95%DB%8C%D8%B1%D8%A7%D9%86.pdf'>$name</a> <i>({$list[$i][1]} ,PDF)</i></div>";
                }
                else {
                    echo "<div class='eee'><span>$num.</span> <a href='$base{$list[$i][0]}'>$name</a> <i>({$list[$i][1]} ,PDF)</i></div>";
                }
            }
            
            ?>
    </main>
    
</div>

<?php
	require_once("../script/php/footer.php");
?>