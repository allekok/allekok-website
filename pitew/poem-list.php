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
<a href="index.php">
    <i style='vertical-align:middle;' class='material-icons'>note_add</i>
    نووسینی شێعر
</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>
<i style='vertical-align:middle;' class='material-icons'></i>
    شێعرەکان
</p>

    <h1 style="background: rgba(0, 153, 255,0.05);color: rgb(0, 138, 230);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
        ئەو شێعرانەی کە نووسیوتانە
    </h1>
    <br>
    <?php
        $db = 'index';
        $q = $_name1 ? "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' and `contributor`='{$_name1}' ORDER BY `id` DESC" : "SELECT `contributor`,`status`,`poem-name`,`poet` FROM `pitew` WHERE `status` LIKE '{\"status\":1%' ORDER BY `id` DESC";
        require("../script/php/condb.php");
        if(!$query) die();
        $_pmnum = num_convert(mysqli_num_rows($query), "en", "ckb");
    ?>
    <div style="color:#555; font-size:0.6em">
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
        
        echo "<section class='pmlist'>{$_l['contributor']}</section><section class='pmlist'><a href='/{$_l['status']['url']}'>{$_l['poet']} &rsaquo; {$_l['poem-name']}</a></section>";
    }
    mysqli_close($conn);
    ?>
</div>

<?php
	require_once("../script/php/footer.php");
?>