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
 .donate-main p {
	 font-size:.6em
 }
 .donation {
	 display:flex;
	 font-size:.5em;
	 padding:.5em 0 0;
	 margin:.5em 0;
	 border-top:1px solid;
 }
 .donation-desc {
	 font-size:.5em;
	 padding:0 1em 0 0;
 }
 .donation div {
	 width:100%;
	 padding:0 .5em;
 }
 .donation .material-icons {
	 padding-left:.2em;
 }
 .donate-main p {
	 text-align:justify;
 }
</style>
<div id="poets" class="donate-main" style="text-align:right">
	<h2 class="color-blue" style="font-size:1em">
		یارمەتیدەران
	</h2>
	<div style="padding-right:1em">
		<?php
		$donations = @file_get_contents("donations.txt");
		if($donations) {
			echo "<p>زۆرسپاس بۆ یارمەتییەکانتان:</p>";
			$donations = explode("-----", $donations);
			foreach($donations as $d) {
				if(!($d = trim($d))) continue;
				$d = explode("\t", $d);
				echo "
<div class='donation'>
<div><i class='material-icons color-blue'>favorite</i>$d[0]</div>
<div>$d[1]</div><div>$d[2]</div></div><div class='donation-desc'>$d[3]</div>";
			}
		}
		else 
			echo "<p>
تا ئێستا هیچ کەس یارمەتی نەناردووە. ئێوە یەکەم کەس بن.</p>";
		?>
	</div>
	<h1 class="color-blue"
	    style="font-size:1em;
		   padding:1em 0 .3em">
		یارمەتی‌دانی ماڵی ئاڵەکۆک
	</h1>
	<div style="padding-right:1em;padding-bottom:2em">
		<p>
			سڵاو بۆ هاوڕێیانی بەڕێزی ئاڵەکۆک، 
		</p>
		<p>
			هەر بەم جۆرەی کە ئاگادارن ئاڵەکۆک بەرنامەیەکە کە لە بەکارهێنەرانی هیچ پارەیەکی وەرناگرێ و هیچ پارەیەکیش عاییدی بەکارهێنەرانی نابێ و بەکارهێنەرانی تەنیا بە ویستی خۆیان ئەم بەرنامەی ڕادەگرن و ئەگەر بکرێ پتەوی دەکەن.
			<br>
			بەڵام ڕاگرتنی ماڵپەڕی ئاڵەکۆک لەسەر هێڵی ئینتێڕنێت پارەی پێویستە هەر بۆیە
			تکایە هەرچەندێکی لەتواناتان دایە یارمەتی‌مان بدەن.
			پێشەکی زۆرسپاسی یارمەتیەکان‌و دەکەم.
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
			<span style="padding: .5em 1em;
				     display: block;
				     text-align: center;
				     border:2px solid;
				     border-radius:1em;
				     margin:1em 0">
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
			<i style="font-weight:bold;
				  direction:ltr;display:inline-block;
				  font-family:monospace;padding:0 .5em"
			>one@allekok.ir</i>
			<br>
			ئایدی تێلێگرامی ئاڵەکۆک:
			<i style="font-weight:bold;
				  direction:ltr;display:inline-block;
				  font-family:monospace;padding:0 .5em"
			>@allekok</i>
		</p>
	</div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
