<?php
require_once("../script/php/constants.php");
require_once("../script/php/colors.php");
require_once("../script/php/functions.php");

$title = $_TITLE . " › یارمەتیی ماڵی";
$desc = "یارمەتیی ماڵی بۆ ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

require_once("../script/php/header.php");
?>
<style>
 .donate-main p {
	 font-size:.6em;
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
 .donate-main code {
	 direction:ltr;
	 text-align:left;
	 display:block;
	 border-left:.5rem solid;
	 padding-left:1rem;
	 font-weight:bold;
 }
</style>
<div id="poets" class="donate-main" style="text-align:right">
	<h1 class="color-blue" style="font-size:1em;padding:1em 0 .3em">
		یارمەتیی ماڵیی ئاڵەکۆک
	</h1>
	<div style="padding-right:1em">
		<p>
			سڵاو بۆ تۆ، هاوڕێی ئاڵەکۆک،
		</p>
		<p>
			ئاڵەکۆک بەرنامەیەکی ئازادە و بۆ هەمیشە ئازاد دەمێنێتەوە.
			<br>
			بەکارهێنانی ئاڵەکۆک هیچ پارەیەکی نەویستووە و هیچ کاتیش نایهەوێ.
			<br>
			بەڵام ڕاگرتنی ئاڵەکۆک لەسەر هێڵی ئینتێرنێت پارەی پێویستە.
			<br>
			هەر بۆیە ئەوەندەی لە تواناییت دا هەیە یارمەتی بدە.
		</p>
		<h3 class="color-blue" style="font-size:.7em;padding-top:1em">
			ڕێگاکانی یارمەتی
		</h3>
		<p style="padding-right:1em">
			١.
			کارتی بانکی "ملی" ئێران بە نێوی "پیام باپیری"
			<br>
			<code>
6037997135394584
			</code>
			<br>
			٢.
			بیت‌کۆین
			<br>
			<code>
bc1qwxqxxpaez8w7y5u4jwf2802txp4h50t825l9kp
			</code>
			<br>
			٣.
			ئیتێریۆم و تێتێر
			<br>
			<code>
0xe918c51034e62e72166645e94c6de66de62ec8b6
			</code>
			<br>
			تکایە نێوی خۆت و ئەندازەی
			یارمەتییەکەت بە ئیمەیل یان تێلێگرام بۆم
			بنێرە.
			زۆر سپاس.
			<br>
			ئیمەیلی ئاڵەکۆک:
			<i style="font-weight:bold;
				  direction:ltr;
				  display:inline-block;
				  font-family:monospace;
				  padding:0 .5em">
				one@allekok.ir
			</i>
			<br>
			ئایدی تێلێگرامی ئاڵەکۆک:
			<i style="font-weight:bold;
				  direction:ltr;
				  display:inline-block;
				  font-family:monospace;
				  padding:0 .5em">
				@allekok
			</i>
		</p>
	</div>
	<h2 class="color-blue" style="font-size:1em">
		یارمەتیدەران
	</h2>
	<div style="padding-right:1em">
		<?php
		const donations_file = "donations.txt";
		$donations = file_exists(donations_file) ?
			     file_get_contents(donations_file) :
			     null;
		if($donations) {
			echo "<p>زۆر سپاس بۆ یارمەتییەکانتان:</p>";
			$donations = explode("-----", $donations);
			foreach($donations as $d) {
				$d = trim($d);
				if(!$d)
					continue;
				$d = explode("\t", $d);
				echo "<div class='donation'><div>" .
				     "<i class='material-icons color-blue'>" .
				     "favorite</i>{$d[0]}</div><div>" .
				     "{$d[1]}</div><div>{$d[2]}</div>" .
				     "</div><div class='donation-desc'>" .
				     "{$d[3]}</div>";
			}
		}
		else {
			echo "<p>" .
			     "تا ئێستا هیچ کەس یارمەتی نەناردووە. ئێوە یەکەم کەس بن." .
			     "</p>";
		}
		?>
	</div>
</div>
<?php
require_once("../script/php/footer.php");
?>
