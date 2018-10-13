<?php

    if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; کۆد &raquo; داگرتنی کۆد";
$desc = "داگرتنی کۆدەکانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
?>
<div id="poets">
    
    <h1><a style="background: #222;color: #19e31b;display: inline-block;padding: 0.3em 0.8em 0;border-radius: 5px;margin: 1em 0 0.5em;text-decoration:none" href='/dev/tools/'>
        ئاڵەکۆک 
    <sup style="font-size:0.55em; vertical-align:top;">
        єv∂
    </sup></a>
    </h1>
    
    <div style="line-height:2.3">
        <p style="font-size:0.6em; text-indent: 2em; text-align:right; max-width: 800px; margin:auto;padding:0 0.6em;">
            ئەو لاپەڕە بە تایبەتی بۆ ئەو کەسانەیە کە شارەزان لە نووسینی کۆدی کامپیوتێڕی دا. ئێوە دەتوانن کۆدەکانی ئاڵەکۆک، داگرن بۆ سەر کامپیوتێڕ یان سێروێری خۆتان.
            <p style="font-size:0.6em; font-weight:bold;">
            خوێندنەوە، گۆڕین و بڵاوکردنەوەی کۆدەکانی ئاڵەکۆک ئازادە.
            </p>
            
        </p>
    </div>
    
    <div style="border-top:1px solid #ddd;margin:0.4em 0 0.8em;"></div>
    
    <div>
        <h2 style="font-size:0.85em;">
            داگرتنی کۆدەکانی ئاڵەکۆک
        </h2>
        <a style="font-size: .6em;background: #222;padding: 1em 1em .75em;display: inline-block;color: #19e31b;font-weight: bold;margin-bottom: .3em;border-radius: 10px;box-shadow: 0 5px 10px -9px #000;letter-spacing:-1px;" href="res/site/allekok.com_2018September.zip">&rsaquo;
            کۆدەکانی ئاڵەکۆک / 2018-September
        </a>
        <div style="font-size:.5em;padding-bottom:2em;">
            گەورەیی:  
            [
            <?php
                echo number_format(filesize("res/site/allekok.com_2018September.zip")/1000000,1) . "MB";
            ?>
            ]
        </div>
        <a style="font-size: .6em;background: #222;padding: 1em 1em .75em;display: inline-block;color: #19e31b;font-weight: bold;margin-bottom: .3em;border-radius: 10px;box-shadow: 0 5px 10px -9px #000;letter-spacing:-1px;" href="res/site/allekok.com_2018August.zip">&rsaquo;
            کۆدەکانی ئاڵەکۆک / 2018-August
        </a>
        <div style="font-size:.5em;padding-bottom:2em;">
            گەورەیی:  
            [
            <?php
                echo number_format(filesize("res/site/allekok.com_2018August.zip")/1000000,1) . "MB";
            ?>
            ]
        </div>
        <a style="font-size: .6em;background: #222;padding: 1em 1em .75em;display: inline-block;color: #19e31b;font-weight: bold;margin-bottom: .3em;border-radius: 10px;box-shadow: 0 5px 10px -9px #000;letter-spacing:-1px;" href="res/site/allekok.com_2018June.zip">&rsaquo;
            کۆدەکانی ئاڵەکۆک / 2018-June
        </a>
        <div style="font-size:.5em;padding-bottom:2em;">
            گەورەیی:  
            [
            <?php
                echo number_format(filesize("res/site/allekok.com_2018June.zip")/1000000,1) . "MB";
            ?>
            ]
        </div>
        <a style="font-size: .6em;background: #222;padding: 1em 1em .75em;display: inline-block;color: #19e31b;font-weight: bold;margin-bottom: .3em;border-radius: 10px;box-shadow: 0 5px 10px -9px #000;letter-spacing:-1px;" href="res/site/allekok.com_2018May.zip">&rsaquo;
            کۆدەکانی ئاڵەکۆک / 2018-May
        </a>
        <div style="font-size:.5em;padding-bottom:2em;">
            گەورەیی:  
            [
            <?php
                echo number_format(filesize("res/site/allekok.com_2018May.zip")/1000000,1) . "MB";
            ?>
            ]
        </div>
    </div>
    
</div>

<?php
	require_once("../script/php/footer.php");
?>