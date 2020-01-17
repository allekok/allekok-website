<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; یارمەتی ماڵی";
$desc = "ناردنی پارە بۆ پشتیوانی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 .donate-main p
 {
     font-size:.6em
 }
</style>
<div id="poets" class="donate-main" style="text-align:right">
    <h1 class="color-blue" style="font-size:1em">
        یارمەتی‌دانی ماڵی ئاڵەکۆک
    </h1>
    <div style="padding-right:1em;padding-bottom:2em">
	<?php
	$date_expire = "2019-12-16";
	$date_expire = date_create($date_expire);
	$date_now = date("Y-m-d");
	$date_now = date_create($date_now);
	$date_diff = date_diff($date_expire, $date_now, true);
	$date_diff_days = num_convert($date_diff->days, "en", "ckb");
	?>
	<h2 class="color-blue" style="text-align:center">
	    <?php
	    echo $date_diff_days;
	    ?>
	    ڕۆژ
	</h2>
	<p>
	    سڵاو بۆ هاوڕێیانی بەڕێزی ئاڵەکۆک، 
	</p>
	<p>
	    تەنیا
	    <?php echo $date_diff_days; ?>
	    ڕۆژ ماوە بۆ تەواو بوونی ڕێکەوتی هاست و دامەنەی ئاڵەکۆک. تکایە ئەگەر دەتانهەوێ ئاڵەکۆک لەسەر هێڵی ئینتێرنێت بمێنێتەوە، یارمەتی‌مان بدەن.
	    <br>
	    هەزینەی ئەم هاست و دامەنەی کە ئێستا بەکاری دێنین، ساڵانە بەپوڵی ئێران ٢٠٠هەزار تمەنە.
	    <br>
	    تکایە هەرچەندێکی لەتواناتان دایە یارمەتی‌مان بدەن.
	    پێشەکی زۆرسپاسی یارمەتی‌و دەکەم.
	</p>
	<h3 class="color-blue" style="font-size:.7em;padding-top:1em">
	    ناردنی پارە لەسەر ئینتێرنێت
	</h3>
	<p style="padding-right:1em">
	    بۆ ئەم شێوە لە یارمەتی دەرگای ئەمنی (زرین‌پال)مان بەکارهێناوە. تکایە لەسەر لینکی خوارەوە کرتە بکەن. پێشەکی سپاس‌و دەکەین.
	    <br>
	    <a href="https://zarinp.al/@allekok"
	       title="یارمەتی‌دانی ماڵی ئاڵەکۆک"
	       class="link-underline" style="display:inline-block;font-weight:bold;text-align:center"
	       target="_blank">
		ناردنی پارە بەشێوەی ئینتێرنێتی
	    </a>
	</p>
	<h3 class="color-blue" style="font-size:.7em;padding-top:1em">
	    ناردنی پارە بەشێوەی ڕاستەوخۆ (کارت بە کارت)
	</h3>
	<p style="padding-right:1em">
	    تکایە یارمەتی‌تان بۆ ژمارە کارتی خوارەوە بنێرن. پێشەکی سپاس‌و دەکەین.
	    <br>
	    <span style="background: #eee;
			 padding: 1em 2em;
			 display: block;
			 text-align: center">
		<span style="letter-spacing: .2em;font-size: 1.3em">
		    ٦٠٣٧٩٩٧١٣٥٣٩٤٥٨٤
		</span>
		<br>
		کارتی بانکی ملی
		<br>
		بە نێوی: پیام باپیری
	    </span>
	    تکایە ئەگەر بەشێوەی ڕاستەوخۆ (کارت بە کارت) یارمەتی‌مان دەدەن، نێوی خۆتان و ئەندازەی یارمەتیەکەتان‌ بە ئیمەیل یان لەسەر تێلێگرام بۆمان بنێرن.
	    <br>
	    ئیمەیلی ئاڵەکۆک:
	    <i style="direction:ltr;display:inline-block;background:#eee;font-family:monospace;padding:0 .5em"
	    >one@allekok.com</i>
	    <br>
	    ئایدی تێلێگرامی ئاڵەکۆک:
	    <i style="direction:ltr;display:inline-block;background:#eee;font-family:monospace;padding:0 .5em"
	    >@allekok</i>
	</p>
	<p style="padding-right:1em">
	</p>
	<h2 class="color-blue" style="font-size:1em">
	    یارمەتیدەران
	</h2>
	<p style="padding-right:1em">
	    تا ئێستا هیچ کەس یارمەتی نەناردووە. ئێوە یەکەم کەس بن.
	</p>
    </div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
