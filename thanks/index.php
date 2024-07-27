<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; سپاس و پێزانین";
$desc = $title;
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 .thanks-main p {
	 font-size:.55em;
	 text-align:justify;
	 margin:.5em 1em 0 0;
	 padding:.5em 1em .5em 0;
	 border-top:1px solid;
 }
</style>
<div id="poets" class="thanks-main">
	<h1 class="color-blue" style="font-size:1em;
		   text-align:right">
		سپاس و پێزانین بۆ...
	</h1>
	<p>
		<i>سپاس</i> &rsaquo; بۆ 
		<a href="<?php echo _R; ?>pitew/contributors/"
		   class="link-underline"
		>هەموو ئەو کەسانەی</a> لە
		<a href="<?php echo _R; ?>pitew/first.php"
		   class="link-underline"
		>پتەوکردنی ئاڵەکۆک</a>
		‌دا یارمەتی‌مان دەدەن.
	</p>
	<p>
		<a href="https://ganjoor.net/" target='_blank'
		   rel='noopener noreferrer nofollow'
		   class="link-underline"
		>گنجور</a> &rsaquo; بۆ بوون بە هۆی دروست بوونی ئاڵەکۆک
	</p>
	<p>
		<a href="<?php echo _R; ?>poet:1/book:4/poem:38"
		   class="link-underline">
			سارینا
		</a>
		&rsaquo;
		کە جێ پەنجەی بوو بە هۆی مانی ئاڵەکۆک
	</p>
	<p>
		<a href="https://www.pinterest.com/rebwarkalid/"
		   target='_blank' rel='noopener noreferrer nofollow'
		   class="link-underline"
		>Rebwar Kalid</a> &rsaquo; بۆ بەشێکی زۆر لە وێنەی شاعیران
	</p>
	<p>
		<a href="https://books.vejin.net/"
		   target='_blank' rel='noopener noreferrer nofollow'
		   class="link-underline"
		>ڤەژینبوکس</a> &rsaquo; بۆ بەشێکی زۆر لە شیعرەکان
	</p>
	<p>
		<a href="http://diyako.yageyziman.com/هۆنراوە/"
		   target='_blank' rel='noopener noreferrer nofollow'
		   class="link-underline"
		>فێرگەی زمانی کوردی</a> &rsaquo; بۆ دیوانی شیعری بەشێک لە شاعیران
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
		<a href="<?php echo _R; ?>poet:80"
		   class="link-underline"
		>کەماڵ ڕەحمانی</a> &rsaquo; بۆ
		<a href="<?php echo _R; ?>poet:65/book:1"
		   class="link-underline"
		>دیوانی شەونمی، حەقیقی</a>
	</p>
	<p>
		<a href="<?php echo _R; ?>poet:80"
		   class="link-underline"
		>کەماڵ ڕەحمانی</a> &rsaquo; بۆ 
		<a href="<?php echo _R; ?>pitew/poem-list.php?name=کەماڵ ڕەحمانی"
		   class="link-underline"
		>نووسینی             
			<?php
			$_name = "کەماڵ ڕەحمانی";
			$q = "SELECT id FROM pitew WHERE 
contributor='$_name' and status 
LIKE '{\"status\":1%'";
			require(ABSPATH.'script/php/condb.php');
			
			if($query)
				echo num_convert(mysqli_num_rows($query),
						 'en','ckb');

			mysqli_close($conn);
			?>
			شیعر لەسەر ئاڵەکۆک
		</a>
	</p>
	<p>
		<a href="http://telegram.me/Kurdish_Poetry"
		   target='_blank' rel='noopener noreferrer nofollow'
		   class="link-underline"
		>کەناڵی تێلێگرامی شیعر و هۆنراوە</a> &rsaquo; 
		بۆ بەشێکی چووک لە 
		<a href="<?php echo _R; ?>poet:82/book:1"
		   class="link-underline"
		>شیعرەکانی سافیی هیرانی</a>
	</p>
	<p>
		<a href="https://www.kurditgroup.org/"
		   target='_blank' rel='noopener noreferrer nofollow'
		   class="link-underline"
		>کوردئایتیگرووپ</a>
		&rsaquo; بۆ 
		<a href="https://www.kurditgroup.org/fontconvertor"
		   target='_blank' rel='noopener noreferrer nofollow'
		   class="link-underline"
		>ئامێری وەرگێڕی فۆنت</a>
		کە بۆ نووسینەوەی بەشێک لە 
		<a href="<?php echo _R; ?>poet:85/book:1"
		   class="link-underline"
		>دیوانی یانەی‌دڵانی، مەدهۆش</a> بەکار هاتووە.
	</p>
	<p>
		<i>
			ئاکۆ مەحموودی، ئاسۆ مەحموودی 
		</i>
		&rsaquo; بۆ 
		<a href="http://kurdinus.com/"
		   target="_blank" class="link-underline"
		>ئامێری پەڵک کوردی‌نووس</a>
		کە بۆ نووسینەوەی بەشێک لە 
		<a href="<?php echo _R; ?>poet:85/book:1"
		   class="link-underline"
		>دیوانی یانەی‌دڵانی، مەدهۆش</a> بەکار هاتووە.
	</p>
	<p>
		<a href="https://www.kurdipedia.org/"
		   class="link-underline"
		   target='_blank' rel='noopener noreferrer nofollow'
		>کوردیپێدیا</a> &rsaquo; بۆ وێنەی 
		<a href="<?php echo _R; ?>poet:50"
		   class="link-underline"
		>بەختیار زێوەر</a>
		و
		<a href="<?php echo _R; ?>poet:71"
		   class="link-underline"
		>شوکری فەزڵی</a>
	</p>
	<p>
		خالید قادری &rsaquo; بۆ نووسینی بەشێکی زۆر لە 
		<a href="<?php echo _R; ?>poet:91/book:10"
		   class="link-underline"
		>دیوانی سەوڵم پۆڵا کەناریش دووری، پەشێو</a>
	</p>
	<p>
		ڕێزان عەلیپوور &rsaquo; بۆ نووسینی بەشێک لە 
		<a href="<?php echo _R; ?>poet:91/book:10"
		   class="link-underline"
		>دیوانی سەوڵم پۆڵا کەناریش دووری، پەشێو</a>
	</p>
	<p>
		ئاکۆ مارانی &rsaquo; بۆ هێنانە سەر ڕێنووسی هۆرامی کۆمەڵێک لە شیعرەکان
	</p>
	<p>
		سیروان دیلان (ئەحمەدپوور) &rsaquo; بۆ نووسینی بەشێک لە
		<a href="<?php echo _R; ?>poet:102/book:1"
		   class="link-underline"
		>دیوانی پیر عابدینی جاف</a>
	</p>
	<p>
		<a href="https://t.me/Aso_Piri"
		   target="_blank"
		   class="link-underline"
		   rel="noopener noreferrer nofollow">
			ئاسۆ پیری
		</a>
		&rsaquo;
		بۆ نووسینی کتێبەشیعری
		<a href="<?php echo _R; ?>poet:58/book:10"
		   class="link-underline"
		>گۆڕستانی چراکان، شێرکۆ بێکەس</a>
		و
		<a href="<?php echo _R; ?>poet:58/book:11"
		   class="link-underline"
		>ئێستا کچێک نیشتمانمە، شێرکۆ بێکەس</a>
	</p>
	<p>
		<a href="https://t.me/ahvanii"
		   target="_blank"
		   class="link-underline"
		   rel="noopener noreferrer nofollow">
			هۆشمەند ڕۆستەمی
		</a>
		&rsaquo;
		بۆ دروست کردنی
		<a href="https://t.me/allekokBot"
		   target="_blank"
		   class="link-underline"
		>ڕۆباتی تێلێگرامی ئاڵەکۆک</a>
	</p>
</div>
<?php
include_once(ABSPATH."script/php/footer.php");
?>
