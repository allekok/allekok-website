<?php

if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");
	
	// check for uploads
	
	if(! empty($_GET['name']) ) $_name1 = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
    
    
    // //////////

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی شێعر &raquo; شێعرەکان";
$desc = "ئەو شێعرانەی کە نووسیوتانە";
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
<a href="index.php" style="color: rgb(0, 138, 230);">
    <i style='vertical-align:middle;' class='material-icons'>note_add</i>
    نووسینی شێعر
</a>
<i style='font-style:normal;'> &rsaquo; </i>
<div id="current-location" style="color: rgb(0, 138, 230);">
    <i style='vertical-align:middle;' class='material-icons'></i>
    شێعرەکان
</div>

</div>

    <?php
        $db = 'index';
        $q = $_name1 ? "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' and `contributor`='{$_name1}' ORDER BY `id` DESC" : "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' ORDER BY `id` DESC";
        require("../script/php/condb.php");
        if(!$query) die();
        $_pmnum = num_convert(mysqli_num_rows($query), "en", "ckb");
    ?>
    <div style="color:#555; font-size:0.6em;margin:1em 0 0">
        ژمارەی شێعرەکان: 
        <?php
            echo $_pmnum;
        ?>
    </div><br>
    <section class='pmlist' style='background:#eee'>یارمەتیدەر</section><section style='background:#eee;text-align:center' class='pmlist'>شێعر</section>

    <?php
    if(! mysqli_num_rows($query))   echo "<span style=\"color:#999;font-size:1em;display:block\">•</span>";

    while($_l = mysqli_fetch_assoc($query)) {
        $_l['status'] = json_decode($_l['status'], true);
        if($_l['poem-name'] === "") $_l['poem-name'] = "شێعر";
        
        echo "<section class='pmlist'>{$_l['contributor']}</section><section class='pmlist'><a class='link' href='/{$_l['status']['url']}'><span style='color:#666;'>{$_l['poet']}</span> &rsaquo; {$_l['poem-name']}</a></section>";
    }
    mysqli_close($conn);
    ?>
</div>

<?php
	require_once("../script/php/footer.php");
?>