<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; سپاس و پێزانین";
$desc = $title;
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 .thanks-main p {
     font-size:.55em;
     text-align:justify;
     padding:.4em 1em .4em .5em;
 }
 .thanks-main a, .thanks-main i {
     padding:0 .6em;
 }
</style>
<div id="poets" class="thanks-main">
    <h1 class="color-blue" style="font-size:1em;
	       text-align:right">
        سپاس و پێزانین بۆ...
    </h1>
    <p>
        <a href="https://ganjoor.net/" target='_blank'
	   rel='noopener noreferrer nofollow'
	   class="link-underline"
	>گنجور</a> &rsaquo; بۆ بوون بە هۆی دروست بوونی ئاڵەکۆک
    </p>
    <p>
        <a href="https://www.pinterest.com/rebwarkalid/"
	   target='_blank' rel='noopener noreferrer nofollow'
	   class="link-underline"
	>Rebwar Tahir</a> &rsaquo; بۆ بەشێکی زۆر لە وێنەی شاعیران
    </p>
    <p>
        <a href="http://www.vejinbooks.com/"
	   target='_blank' rel='noopener noreferrer nofollow'
	   class="link-underline"
	>ڤەژین بوکس</a> &rsaquo; بۆ بەشێکی زۆر لە شێعرەکان
    </p>
    <p>
        <a href="http://diyako.yageyziman.com/هۆنراوە/"
	   target='_blank' rel='noopener noreferrer nofollow'
	   class="link-underline"
	>فێرگەی زمانی کوردی</a> &rsaquo; بۆ دیوانی شێعری بەشێک لە شاعیران
    </p>
    <p>
        <a href="http://www.bokan.de/laperekan/Edebiat/awat/Awat.htm"
	   target='_blank' rel='noopener noreferrer nofollow'
	   class="link-underline"
	>رۆژهەڵات / بۆکان</a> &rsaquo; بۆ 
        <a href="/poet:62/book:1"
	   class="link-underline"
	>دیوانی شاری دڵی، ئاوات</a>
    </p>
    <p>
        <a href="https://t.me/chapkagolibevena"
	   target='_blank' rel='noopener noreferrer nofollow'
	   class="link-underline"
	>کەناڵی تێلێگرامی چەپکەگوڵ</a> و
	<a href="/poet:80"
	   class="link-underline"
	>کەماڵ ڕەحمانی</a> &rsaquo; بۆ
        <a href="/poet:65/book:1"
	   class="link-underline"
	>دیوانی شەونمی، حەقیقی</a>
    </p>
    <p>
        <a href="/poet:80"
	   class="link-underline"
	>کەماڵ ڕەحمانی</a> &rsaquo; بۆ 
        <a href="/pitew/poem-list.php?name=کەماڵ ڕەحمانی"
	   class="link-underline"
	>نووسینی             
	    <?php
	    $_name = "کەماڵ ڕەحمانی";
	    $db = 'index';
	    $q = "SELECT id FROM pitew WHERE 
contributor='$_name' and status 
LIKE '{\"status\":1%'";
	    require(ABSPATH.'script/php/condb.php');
	    
	    if($query)
		echo num_convert(mysqli_num_rows($query),
				 'en','ckb');

	    mysqli_close($conn);
	    ?>
            شێعر لەسەر ئاڵەکۆک
        </a>
    </p>
    <p>
        <a href="http://telegram.me/Kurdish_Poetry"
	   target='_blank' rel='noopener noreferrer nofollow'
	   class="link-underline"
	>کەناڵی تێلێگرامی شیعر و هۆنراوە</a> &rsaquo; 
        بۆ بەشێکی چووک لە 
        <a href="/poet:82/book:1"
	   class="link-underline"
	>شێعرەکانی سافیی هیرانی</a>
    </p>
    <p>
        <a href="https://www.kurditgroup.org/"
	   class="link-underline"
	>کوردئایتیگرووپ</a>
        &rsaquo; بۆ 
        <a href="https://www.kurditgroup.org/fontconvertor"
	   class="link-underline"
	>ئامێری وەرگێڕی فۆنت</a>
        کە بۆ نووسینەوەی بەشێک لە 
        <a href="/poet:85/book:1"
	   class="link-underline"
	>دیوانی یانەی‌دڵانی، مدهۆش</a> بەکار هاتووە.
    </p>
    <p>
        <i>
            ئاکۆ مەحموودی، ئاسۆ مەحموودی 
        </i>
        &rsaquo; بۆ 
        <a href="/kurdi-nus/kurdi-nus-central-kurdish.html"
	   class="link-underline"
	>ئامێری پەڵک کوردی‌نووس</a>
        کە بۆ نووسینەوەی بەشێک لە 
        <a href="/poet:85/book:1"
	   class="link-underline"
	>دیوانی یانەی‌دڵانی، مدهۆش</a> بەکار هاتووە.
    </p>
    <p>
	<a href="https://www.kurdipedia.org/"
	   class="link-underline"
	   target='_blank' rel='noopener noreferrer nofollow'
	>کوردیپێدیا</a> &rsaquo; بۆ وێنەی 
	<a href="/poet:50"
	   class="link-underline"
	>بەختیار زێوەر</a>
	و
	<a href="/poet:71"
	   class="link-underline"
	>شوکری فەزڵی</a>
    </p>
    <p>
	<i>سپاس</i> &rsaquo; بۆ 
	<a href="/pitew/contributors/"
	   class="link-underline"
	>هەموو ئەو کەسانەی</a> لە
	<a href="/pitew/first.php"
	   class="link-underline"
	>پتەوکردنی ئاڵەکۆک</a>
	‌دا یارمەتی‌مان دەدەن.
    </p>
</div>
<?php
include_once(ABSPATH."script/php/footer.php");
?>
