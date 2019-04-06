<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; سپاس و پێزانین";
$desc = $title;
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>

<style>
 p {
     font-size:.6em;border-bottom: 2px dashed #f2f2f2;text-align: right;padding:.6em .2em;
 }
 #poets a {
     font-size: inherit;padding:0 .6em;border-radius:2px;display:inline-block;margin:.1em 0;
 }
 #poets a:hover {
     text-decoration:none;
     box-shadow:0 3px 5px -2px #aaa;
 }
</style>
<div id="poets" style="margin-bottom:4em;max-width:800px">
    <h1 style="margin-bottom:.5em;font-size:1em">
        سپاس و پێ‌زانین بۆ:
    </h1>
    
    <p>
        <a href="http://ganjoor.net/" target='_blank' rel='noopener noreferrer nofollow' style="background-color:#f9cea4;">گنجور</a> &rsaquo; بۆ بوون بە هۆی دروست بوونی ئاڵەکۆک
    </p>
    <p>
        <a href="https://plus.google.com/+RebwarTahir" target='_blank' rel='noopener noreferrer nofollow' style="color:#fff;background-color:#dd5144;font-weight:bold;">Rebwar Tahir</a> &rsaquo; بۆ بەشێکی زۆر لە وێنەی شاعیران
    </p>
    <p>
        <a href="http://www.vejinbooks.com/" target='_blank' rel='noopener noreferrer nofollow' style="color:#900000;">ڤەژین بوکس</a> &rsaquo; بۆ بەشێکی زۆر لە شێعرەکان
    </p>
    <p>
        <a href="http://diyako.yageyziman.com/هۆنراوە/" target='_blank' rel='noopener noreferrer nofollow' style="color:#fff;background-color:#1e73be;">فێرگەی زمانی کوردی</a> &rsaquo; بۆ دیوانی شێعری بەشێک لە شاعیران
    </p>
    <p>
        <a href="http://www.bokan.de/laperekan/Edebiat/awat/Awat.htm" target='_blank' rel='noopener noreferrer nofollow' style="color:#820e0e;background-color:#fcc601;">رۆژهەڵات / بۆکان</a> &rsaquo; بۆ 
        <a href="<?php echo _SITE; ?>poet:62/book:1" style="color:<?php echo $colors[0][3]; ?>;background-color:<?php echo $colors[0][2]; ?>;">دیوانی شاری دڵی، ئاوات</a>
    </p>
    <p>
        <a href="https://t.me/chapkagolibevena" target='_blank' rel='noopener noreferrer nofollow' style="color:#fff;background-color:#0088cc;">کەناڵی تێلێگرامی چەپکەگوڵ</a> و <a href="<?php echo _SITE; ?>poet:80" style="color:<?php echo $colors[0][1]; ?>;background-color:<?php echo $colors[0][0]; ?>;">کەماڵ ڕەحمانی</a> &rsaquo; بۆ
        <a href="<?php echo _SITE; ?>poet:65/book:1" style="color:<?php echo $colors[0][3]; ?>;background-color:<?php echo $colors[0][2]; ?>;">دیوانی شەونمی، حەقیقی</a>
    </p>
    <p>
        <a href="<?php echo _SITE; ?>poet:80" style="color:<?php echo $colors[0][1]; ?>;background-color:<?php echo $colors[0][0]; ?>;">کەماڵ ڕەحمانی</a>
        &rsaquo;
        بۆ
        <a href="https://allekok.com/pitew/poem-list.php?name=%DA%A9%DB%95%D9%85%D8%A7%DA%B5%20%DA%95%DB%95%D8%AD%D9%85%D8%A7%D9%86%DB%8C" style="color:<?php echo $colors[0][3]; ?>;background-color:<?php echo $colors[0][2]; ?>;">
            نووسینی 
            <span style="color:#666; opacity:0;" id="pitew-stats">.....</span>
            شێعر لەسەر ئاڵەکۆک
        </a>
	
	<script>
         var name = "کەماڵ ڕەحمانی";
         var res = document.getElementById("pitew-stats");
         xmlhttp = new XMLHttpRequest();
         xmlhttp.onload = function() {
             if(this.responseText !== "") {
                 res.innerHTML = this.responseText; 

                 res.style.animation = "tL 1.2s ease forwards";
             }
         }
         
         xmlhttp.open("get", `/pitew/stats.php?contributor=${name}`, true);
         xmlhttp.send();
	</script>
	
    </p>
    
    <p>
        <a href="http://telegram.me/Kurdish_Poetry" target='_blank' rel='noopener noreferrer nofollow' style="color:#fff;background-color:#0088cc;">کەناڵی تێلێگرامی شیعر و هۆنراوە</a>
        &rsaquo; 
        بۆ بەشێکی چووک لە 
        <a href="/poet:82/book:1" style="color:<?php echo $colors[0][3]; ?>;background-color:<?php echo $colors[0][2]; ?>;">
            شێعرەکانی سافیی هیرانی
        </a>
    </p>
    <p>
        <a href="https://www.kurditgroup.org/" style="color:#26678c">
            کوردئایتیگرووپ
        </a>
        &rsaquo; بۆ  
        <a href="https://www.kurditgroup.org/fontconvertor" style="color:#26678c">ئامێری وەرگێڕی فۆنت 
        </a>
        کە بۆ نووسینەوەی بەشێک لە 
        <a href="<?php echo _SITE; ?>poet:85/book:1" style="background:<?php echo $colors[0][2]; ?>; color:<?php echo $colors[0][3]; ?>">
            دیوانی یانەی‌دڵانی، مدهۆش</a>  بەکار هاتووە.
    </p>
    <p>
        <i style="color:#4699EC;">
            ئاکۆ مەحموودی، ئاسۆ مەحموودی 
        </i>
        &rsaquo;
        بۆ 
        <a href="https://www.allekok.com/Kurdi-Nus/Kurdi%20Nus%204.0%20Kurdish.html" style="color:#4699EC;">
            ئامێری پەڵک کوردی‌نووس ۴.۰
        </a>
        کە بۆ نووسینەوەی بەشێک لە 
        <a href="<?php echo _SITE; ?>poet:85/book:1" style="background:<?php echo $colors[0][2]; ?>; color:<?php echo $colors[0][3]; ?>">
            دیوانی یانەی‌دڵانی، مدهۆش</a>  بەکار هاتووە.
    </p>
    <p>
	<a href="https://www.kurdipedia.org/" style="color:#0207ff;" target='_blank' rel='noopener noreferrer nofollow'>کوردیپێدیا</a>
	&rsaquo;
	بۆ وێنەی
	<a href="/poet:50" style="color:<?php echo $colors[0][3]; ?>;background-color:<?php echo $colors[0][2]; ?>;">بەختیار زێوەر</a>
	و
	<a href="/poet:71" style="color:<?php echo $colors[0][3]; ?>;background-color:<?php echo $colors[0][2]; ?>;">شوکری فەزڵی</a>
    </p>
    <p style="text-align:center;">
        سپاس بۆ هەموو ئەو کەسانەی کە لە پتەوکردنی ئاڵەکۆک‌دا یارمەتی‌مان دەدەن.
    </p>
    
</div>


<?php
include_once("../script/php/footer.php");
?>
