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
     font-size:.6em;
     text-align:right;padding:.6em .2em
 }
 #poets a, #poets i {
     font-size:inherit;padding:0 .6em;
     border-radius:2px;display:inline-block;
     margin:.1em 0
 }
 #poets a:hover {
     text-decoration:none;
     box-shadow:0 3px 5px -2px #aaa
 }
</style>
<div id="poets"
     style="margin-bottom:1em;max-width:800px">
    <h1 style="font-size:1.2em;
	       padding:.1em .8em 0">
        سپاس و پێ‌زانین بۆ:
    </h1>
    <p class='border-bottom-eee'>
        <a href="https://ganjoor.net/" target='_blank'
	   rel='noopener noreferrer nofollow'
	   style="background:#f9cea4;color:#000"
	>گنجور</a> &rsaquo; بۆ بوون بە هۆی دروست بوونی ئاڵەکۆک
    </p>
    <p class='border-bottom-eee'>
        <a href="https://www.pinterest.com/rebwarkalid/"
	   target='_blank' rel='noopener noreferrer nofollow'
	   style="color:#fff;background:#dd5144;
		 font-weight:bold"
	>Rebwar Tahir</a> &rsaquo; بۆ بەشێکی زۆر لە وێنەی شاعیران
    </p>
    <p class='border-bottom-eee'>
        <a href="http://www.vejinbooks.com/"
	   target='_blank' rel='noopener noreferrer nofollow'
	   style="background:#900000;color:#fff"
	>ڤەژین بوکس</a> &rsaquo; بۆ بەشێکی زۆر لە شێعرەکان
    </p>
    <p class='border-bottom-eee'>
        <a href="http://diyako.yageyziman.com/هۆنراوە/"
	   target='_blank' rel='noopener noreferrer nofollow'
	   style="color:#fff;background:#1e73be"
	>فێرگەی زمانی کوردی</a> &rsaquo; بۆ دیوانی شێعری بەشێک لە شاعیران
    </p>
    <p class='border-bottom-eee'>
        <a href="http://www.bokan.de/laperekan/Edebiat/awat/Awat.htm"
	   target='_blank' rel='noopener noreferrer nofollow'
	   style="color:#820e0e;background:#fcc601"
	>رۆژهەڵات / بۆکان</a> &rsaquo; بۆ 
        <a href="/poet:62/book:1"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>دیوانی شاری دڵی، ئاوات</a>
    </p>
    <p class='border-bottom-eee'>
        <a href="https://t.me/chapkagolibevena"
	   target='_blank' rel='noopener noreferrer nofollow'
	   style="color:#fff;background:#0088cc"
	>کەناڵی تێلێگرامی چەپکەگوڵ</a> و
	<a href="/poet:80"
	   style="color:<?php echo $colors[0][1]; ?>;
		 background:<?php echo $colors[0][0]; ?>"
	>کەماڵ ڕەحمانی</a> &rsaquo; بۆ
        <a href="/poet:65/book:1"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>دیوانی شەونمی، حەقیقی</a>
    </p>
    <p class='border-bottom-eee'>
        <a href="/poet:80"
	   style="color:<?php echo $colors[0][1]; ?>;
		 background:<?php echo $colors[0][0]; ?>"
	>کەماڵ ڕەحمانی</a> &rsaquo; بۆ 
        <a href="/pitew/poem-list.php?name=کەماڵ ڕەحمانی"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>نووسینی 
            <span style="color:#666;opacity:0"
		  id="pitew-stats">.....</span>
            شێعر لەسەر ئاڵەکۆک
        </a>
	<script>
	 window.onload = function() {
             var name = "کەماڵ ڕەحمانی",
		 res = document.getElementById("pitew-stats");
             getUrl(`/pitew/stats.php?contributor=${name}`,
		    function(responseText) {
			if(responseText !== "") {
			    res.innerHTML = responseText; 
			    res.style.animation =
				"tL 1.2s ease forwards";
			}
		    });
	 }
	</script>
    </p>
    <p class='border-bottom-eee'>
        <a href="http://telegram.me/Kurdish_Poetry"
	   target='_blank' rel='noopener noreferrer nofollow'
	   style="color:#fff;background:#0088cc"
	>کەناڵی تێلێگرامی شیعر و هۆنراوە</a> &rsaquo; 
        بۆ بەشێکی چووک لە 
        <a href="/poet:82/book:1"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>شێعرەکانی سافیی هیرانی</a>
    </p>
    <p class='border-bottom-eee'>
        <a href="https://www.kurditgroup.org/"
	   style="background:#26678c;color:#fff"
	>کوردئایتیگرووپ</a>
        &rsaquo; بۆ  
        <a href="https://www.kurditgroup.org/fontconvertor"
	   style="background:#26678c;color:#fff"
	>ئامێری وەرگێڕی فۆنت</a>
        کە بۆ نووسینەوەی بەشێک لە 
        <a href="/poet:85/book:1"
	   style="background:<?php echo $colors[0][2]; ?>;
		 color:<?php echo $colors[0][3]; ?>"
	>دیوانی یانەی‌دڵانی، مدهۆش</a> بەکار هاتووە.
    </p>
    <p class='border-bottom-eee'>
        <i style="background:#4699EC;color:#fff">
            ئاکۆ مەحموودی، ئاسۆ مەحموودی 
        </i>
        &rsaquo; بۆ 
        <a href="/kurdi-nus/kurdi-nus-kurdish.html"
	   style="background:#4699EC;color:#fff"
	>ئامێری پەڵک کوردی‌نووس ۴.۰</a>
        کە بۆ نووسینەوەی بەشێک لە 
        <a href="/poet:85/book:1"
	   style="background:<?php echo $colors[0][2]; ?>;
		 color:<?php echo $colors[0][3]; ?>"
	>دیوانی یانەی‌دڵانی، مدهۆش</a> بەکار هاتووە.
    </p>
    <p class='border-bottom-eee'>
	<a href="https://www.kurdipedia.org/"
	   style="background:#0207ff;color:#fff"
	   target='_blank' rel='noopener noreferrer nofollow'
	>کوردیپێدیا</a> &rsaquo; بۆ وێنەی 
	<a href="/poet:50"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>بەختیار زێوەر</a>
	و
	<a href="/poet:71"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>شوکری فەزڵی</a>
    </p>
    <p class='border-bottom-eee'>
	<i style="background:<?php echo $colors[0][0]; ?>;
		  color:<?php echo $colors[0][1]; ?>"
	>سپاسی تایبەت</i> &rsaquo; بۆ 
	<a href="/pitew/contributors/"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>هەموو ئەو کەسانەی</a> کە لە 
	<a href="/pitew/first.php"
	   style="color:<?php echo $colors[0][3]; ?>;
		 background:<?php echo $colors[0][2]; ?>"
	>پتەوکردنی ئاڵەکۆک</a>
	‌دا یارمەتی‌مان دەدەن.
    </p>
</div>
<?php
include_once(ABSPATH."script/php/footer.php");
?>
