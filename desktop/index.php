<?php
require_once("../script/php/constants.php");
require_once("../script/php/colors.php");
require_once("../script/php/functions.php");

$title = $_TITLE . " › داگرتنی بەرنامەی ئاڵەکۆک";
$desc = "داگرتنی بەرنامەی ئاڵەکۆک بۆ لینوکس و ئەندرۆید و ئای ئۆ ئێس";
$keys = $_KEYS;
$t_desc = "";

require_once("../script/php/header.php");
?>
<style>
 .pitewsec-desktop {
	 font-size:1.2em;
 }
 .comment {
	 border-top:1px solid;
 }
 .comm-body {
	 border:0;
 }
</style>
<div id="poets" style="text-align:right">
	<h1 class="color-blue" style="font-size:1em">
		دابەزاندنی بەرنامەی ئاڵەکۆک
	</h1>
	<div style="padding-right:1em">
		<section class="pitewsec pitewsec-desktop">
			<svg style="width:2em;vertical-align:middle;fill:<?php echo $_colors[1]; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M196.1 123.6c-.2-1.4 1.9-2.3 3.2-2.9 1.7-.7 3.9-1 5.5-.1.4.2.8.7.6 1.1-.4 1.2-2.4 1-3.5 1.6-1 .5-1.8 1.7-3 1.7-1 .1-2.7-.4-2.8-1.4zm24.7-.3c1 .5 1.8 1.7 3 1.7 1.1 0 2.8-.4 2.9-1.5.2-1.4-1.9-2.3-3.2-2.9-1.7-.7-3.9-1-5.5-.1-.4.2-.8.7-.6 1.1.3 1.3 2.3 1.1 3.4 1.7zm214.7 310.2c-.5 8.2-6.5 13.8-13.9 18.3-14.9 9-37.3 15.8-50.9 32.2l-2.6-2.2 2.6 2.2c-14.2 16.9-31.7 26.6-48.3 27.9-16.5 1.3-32-6.3-40.3-23v-.1c-1.1-2.1-1.9-4.4-2.5-6.7-21.5 1.2-40.2-5.3-55.1-4.1-22 1.2-35.8 6.5-48.3 6.6-4.8 10.6-14.3 17.6-25.9 20.2-16 3.7-36.1 0-55.9-10.4l1.6-3-1.6 3c-18.5-9.8-42-8.9-59.3-12.5-8.7-1.8-16.3-5-20.1-12.3-3.7-7.3-3-17.3 2.2-31.7 1.7-5.1.4-12.7-.8-20.8-.6-3.9-1.2-7.9-1.2-11.8 0-4.3.7-8.5 2.8-12.4 4.5-8.5 11.8-12.1 18.5-14.5 6.7-2.4 12.8-4 17-8.3 5.2-5.5 10.1-14.4 16.6-20.2-2.6-17.2.2-35.4 6.2-53.3 12.6-37.9 39.2-74.2 58.1-96.7 16.1-22.9 20.8-41.3 22.5-64.7C158 103.4 132.4-.2 234.8 0c80.9.1 76.3 85.4 75.8 131.3-.3 30.1 16.3 50.5 33.4 72 15.2 18 35.1 44.3 46.5 74.4 9.3 24.6 12.9 51.8 3.7 79.1 1.4.5 2.8 1.2 4.1 2 1.4.8 2.7 1.8 4 2.9 6.6 5.6 8.7 14.3 10.5 22.4 1.9 8.1 3.6 15.7 7.2 19.7 11.1 12.4 15.9 21.5 15.5 29.7zM220.8 109.1c3.6.9 8.9 2.4 13 4.4-2.1-12.2 4.5-23.5 11.8-23 8.9.3 13.9 15.5 9.1 27.3-.8 1.9-2.8 3.4-3.9 4.6 6.7 2.3 11 4.1 12.6 4.9 7.9-9.5 10.8-26.2 4.3-40.4-9.8-21.4-34.2-21.8-44 .4-3.2 7.2-3.9 14.9-2.9 21.8zm-46.2 18.8c7.8-5.7 6.9-4.7 5.9-5.5-8-6.9-6.6-27.4 1.8-28.1 6.3-.5 10.8 10.7 9.6 19.6 3.1-2.1 6.7-3.6 10.2-4.6 1.7-19.3-9-33.5-19.1-33.5-18.9 0-24 37.5-8.4 52.1zm-9.4 20.9c1.5 4.9 6.1 10.5 14.7 15.3 7.8 4.6 12 11.5 20 15 2.6 1.1 5.7 1.9 9.6 2.1 18.4 1.1 27.1-11.3 38.2-14.9 11.7-3.7 20.1-11 22.7-18.1 3.2-8.5-2.1-14.7-10.5-18.2-11.3-4.9-16.3-5.2-22.6-9.3-10.3-6.6-18.8-8.9-25.9-8.9-14.4 0-23.2 9.8-27.9 14.2-.5.5-7.9 5.9-14.1 10.5-4.2 3.3-5.6 7.4-4.2 12.3zm-33.5 252.8L112.1 366c-6.8-9.2-13.8-14.8-21.9-16-7.7-1.2-12.6 1.4-17.7 6.9-4.8 5.1-8.8 12.3-14.3 18-7.8 6.5-9.3 6.2-19.6 9.9-6.3 2.2-11.3 4.6-14.8 11.3-2.7 5-2.1 12.2-.9 20 1.2 7.9 3 16.3.6 23.9v.2c-5 13.7-5 21.7-2.6 26.4 7.9 15.4 46.6 6.1 76.5 21.9 31.4 16.4 72.6 17.1 75.3-18 2.1-20.5-31.5-49-41-68.9zm153.9 35.8c3.2-11 6.3-21.3 6.8-29 .8-15.2 1.6-28.7 4.4-39.9 3.1-12.6 9.3-23.1 21.4-27.3 2.3-21.1 18.7-21.1 38.3-12.5 18.9 8.5 26 16 22.8 26.1 1 0 2-.1 4.2 0 5.2-16.9-14.3-28-30.7-34.8 2.9-12 2.4-24.1-.4-35.7-6-25.3-22.6-47.8-35.2-59-2.3-.1-2.1 1.9 2.6 6.5 11.6 10.7 37.1 49.2 23.3 84.9-3.9-1-7.6-1.5-10.9-1.4-5.3-29.1-17.5-53.2-23.6-64.6-11.5-21.4-29.5-65.3-37.2-95.7-4.5 6.4-12.4 11.9-22.3 15-4.7 1.5-9.7 5.5-15.9 9-13.9 8-30 8.8-42.4-1.2-4.5-3.6-8-7.6-12.6-10.3-1.6-.9-5.1-3.3-6.2-4.1-2 37.8-27.3 85.3-39.3 112.7-8.3 19.7-13.2 40.8-13.8 61.5-21.8-29.1-5.9-66.3 2.6-82.4 9.5-17.6 11-22.5 8.7-20.8-8.6 14-22 36.3-27.2 59.2-2.7 11.9-3.2 24 .3 35.2 3.5 11.2 11.1 21.5 24.6 29.9 0 0 24.8 14.3 38.3 32.5 7.4 10 9.7 18.7 7.4 24.9-2.5 6.7-9.6 8.9-16.7 8.9 4.8 6 10.3 13 14.4 19.6 37.6 25.7 82.2 15.7 114.3-7.2zM415 408.5c-10-11.3-7.2-33.1-17.1-41.6-6.9-6-13.6-5.4-22.6-5.1-7.7 8.8-25.8 19.6-38.4 16.3-11.5-2.9-18-16.3-18.8-29.5-.3.2-.7.3-1 .5-7.1 3.9-11.1 10.8-13.7 21.1-2.5 10.2-3.4 23.5-4.2 38.7-.7 11.8-6.2 26.4-9.9 40.6-3.5 13.2-5.8 25.2-1.1 36.3 7.2 14.5 19.5 20.4 33.7 19.3 14.2-1.1 30.4-9.8 43.6-25.5 22-26.6 62.3-29.7 63.2-46.5.3-5.1-3.1-13-13.7-24.6zM173.3 148.7c2 1.9 4.7 4.5 8 7.1 6.6 5.2 15.8 10.6 27.3 10.6 11.6 0 22.5-5.9 31.8-10.8 4.9-2.6 10.9-7 14.8-10.4 3.9-3.4 5.9-6.3 3.1-6.6-2.8-.3-2.6 2.6-6 5.1-4.4 3.2-9.7 7.4-13.9 9.8-7.4 4.2-19.5 10.2-29.9 10.2-10.4 0-18.7-4.8-24.9-9.7-3.1-2.5-5.7-5-7.7-6.9-1.5-1.4-1.9-4.6-4.3-4.9-1.4-.1-1.8 3.7 1.7 6.5z"/></svg>
			<small>
				<a href="https://github.com/allekok/allekok-desktop/releases/download/v1.2.4/allekok-1.2.4.AppImage"
				   target="_blank">
					دابەزاندن بۆ لینوکس
				</a>
				<small style="font-size:.7em;display:block">
					وەشانی ۱.۲.٤ -
					<a href="https://github.com/allekok/allekok-desktop/releases/"
					   rel="noopener noreferrer nofollow"
					   target="_blank">
						وەشانەکانی تر...
					</a>
				</small>
			</small>
		</section>
		<section class="pitewsec pitewsec-desktop">
			<svg style="width:2em;vertical-align:middle;fill:<?php echo $_colors[1]; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M89.6 204.5v115.8c0 15.4-12.1 27.7-27.5 27.7-15.3 0-30.1-12.4-30.1-27.7V204.5c0-15.1 14.8-27.5 30.1-27.5 15.1 0 27.5 12.4 27.5 27.5zm10.8 157c0 16.4 13.2 29.6 29.6 29.6h19.9l.3 61.1c0 36.9 55.2 36.6 55.2 0v-61.1h37.2v61.1c0 36.7 55.5 36.8 55.5 0v-61.1h20.2c16.2 0 29.4-13.2 29.4-29.6V182.1H100.4v179.4zm248-189.1H99.3c0-42.8 25.6-80 63.6-99.4l-19.1-35.3c-2.8-4.9 4.3-8 6.7-3.8l19.4 35.6c34.9-15.5 75-14.7 108.3 0L297.5 34c2.5-4.3 9.5-1.1 6.7 3.8L285.1 73c37.7 19.4 63.3 56.6 63.3 99.4zm-170.7-55.5c0-5.7-4.6-10.5-10.5-10.5-5.7 0-10.2 4.8-10.2 10.5s4.6 10.5 10.2 10.5c5.9 0 10.5-4.8 10.5-10.5zm113.4 0c0-5.7-4.6-10.5-10.2-10.5-5.9 0-10.5 4.8-10.5 10.5s4.6 10.5 10.5 10.5c5.6 0 10.2-4.8 10.2-10.5zm94.8 60.1c-15.1 0-27.5 12.1-27.5 27.5v115.8c0 15.4 12.4 27.7 27.5 27.7 15.4 0 30.1-12.4 30.1-27.7V204.5c0-15.4-14.8-27.5-30.1-27.5z"/></svg>
			<small>
				<a href="https://github.com/allekok/allekok-android/releases/download/v1.2.4/allekok-v1.2.4.apk"
				   target="_blank">
					دابەزاندن بۆ ئەندرۆید
				</a>
				<small style="font-size:.7em;display:block">
					وەشانی ١.٢.٤ -
					بۆ ئەندرۆیدی ٤.١ بۆ سەرێ
				</small>
			</small>
		</section>
		<section class="pitewsec pitewsec-desktop">
			<svg style="width:2em;vertical-align:middle;fill:<?php echo $_colors[1]; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Free 5.15.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM127 384.5c-5.5 9.6-17.8 12.8-27.3 7.3-9.6-5.5-12.8-17.8-7.3-27.3l14.3-24.7c16.1-4.9 29.3-1.1 39.6 11.4L127 384.5zm138.9-53.9H84c-11 0-20-9-20-20s9-20 20-20h51l65.4-113.2-20.5-35.4c-5.5-9.6-2.2-21.8 7.3-27.3 9.6-5.5 21.8-2.2 27.3 7.3l8.9 15.4 8.9-15.4c5.5-9.6 17.8-12.8 27.3-7.3 9.6 5.5 12.8 17.8 7.3 27.3l-85.8 148.6h62.1c20.2 0 31.5 23.7 22.7 40zm98.1 0h-29l19.6 33.9c5.5 9.6 2.2 21.8-7.3 27.3-9.6 5.5-21.8 2.2-27.3-7.3-32.9-56.9-57.5-99.7-74-128.1-16.7-29-4.8-58 7.1-67.8 13.1 22.7 32.7 56.7 58.9 102h52c11 0 20 9 20 20 0 11.1-9 20-20 20z"/></svg>
			<small>
				<a href="https://allekok.ir/offline/"
				   target="_blank">
					دابەزاندن بۆ ئای ئۆ ئێس
				</a>
				<small style="font-size:.7em;display:block">
					هاوڕێیان بۆ دابەزاندنی بەرنامەی ئاڵەکۆک بۆ ئای ئۆ ئێس سەردانی
					<a href="https://allekok.ir/offline/"
					   class="color-blue"
					   target="_blank">
						ئەم لاپەڕە
					</a>
					بکەن و ئەو کارانەی وێنەی خوارەوە ئەنجام بدەن.
				</small>
				<a href="allekok-web.jpg" target="_blank">
					<img src="allekok-web.jpg"
					     style="display:block;
						  margin:auto;
						  max-width:100%;
						  border-radius:.5em">
				</a>
			</small>
		</section>
	</div>
	<h1 class="color-blue" style="font-size:1em">
		کۆدەکانی بەرنامەی ئاڵەکۆک
	</h1>
	<div style="padding-right:1em">
		<a href="https://github.com/allekok/allekok-web"
		   rel="noopener noreferrer nofollow"
		   style="display:block;font-size:.6em"
		   title="کۆدەکانی بەرنامەی ئای ئۆ ئێسی ئاڵەکۆک"
		   target="_blank">
			کۆدەکانی بەرنامەی ئای ئۆ ئێسی ئاڵەکۆک
		</a>
		<a href="https://github.com/allekok/allekok-android"
		   rel="noopener noreferrer nofollow"
		   style="display:block;font-size:.6em"
		   title="کۆدەکانی بەرنامەی ئەندرۆیدی ئاڵەکۆک"
		   target="_blank">
			کۆدەکانی بەرنامەی ئەندرۆیدی ئاڵەکۆک
		</a>
		<a href="https://github.com/allekok/allekok-desktop"
		   rel="noopener noreferrer nofollow"
		   style="display:block;font-size:.6em"
		   title="کۆدەکانی بەرنامەی دێسکتاپی ئاڵەکۆک"
		   target="_blank">
			کۆدەکانی بەرنامەی دێسکتاپی ئاڵەکۆک
		</a>
	</div>
	<h1 class="color-blue" style="font-size:1em;padding-top:.5em">
		بیر و ڕاکان
	</h1>
	<div style="padding-right:1em">
		<form id="frmQA" action="save.php" method="POST">
			<textarea id="QAtxt"
				  class="QAtxt-desktop"
				  placeholder="بیر و ڕای خۆتان سەبارەت بە بەرنامەی دێسکتاپی ئاڵەکۆک لێرە بنووسن."></textarea>
			<div id="QAres"></div>
			<button type="submit" class="button btn-desktop">ناردن</button>
		</form>
		<div style="padding-top:1em">
			<?php
			const QA_path = "QA.txt";
			if(file_exists(QA_path) and filesize(QA_path) > 0) {
				$cc = file_get_contents(QA_path);
				$cc = array_reverse(explode("\nend\n", $cc));
				foreach($cc as $c) {
					if(empty($c))
						continue;
					$c = preg_replace(["/\[code\]\n*/",
							   "/\n*\[\/code\]/"],
							  ["<code>",
							   "</code>"],
							  $c);
					$c = str_replace(["\n"], ["<br>"], $c);
					echo "<div class='comment'>" .
					     "<div class='comm-body'>" .
					     "{$c}</div></div>";
				}
			}
			?>
		</div>
	</div>
</div>
<script>
 document.getElementById('frmQA').addEventListener('submit', e => {
	 const txt = document.querySelector("#QAtxt"),
	       t = document.querySelector("#QAres"),
	       loader = "<div class='loader'></div>"

	 e.preventDefault()

	 if(!txt.value) {
		 txt.focus()
		 return
	 }

	 t.innerHTML = loader

	 const x = new XMLHttpRequest()
	 x.onload = () => {
		 if(x.responseText != '1')
			 return
		 txt.value = ''
		 t.innerHTML = '<div class="color-blue" style="' +
			       'font-size:1rem;' +
			       'text-align:center;' +
			       'padding-top:1rem">' +
			       'زۆر سپاس بۆ دەربڕینی بیر و ڕاتان.' +
			       '</div>'
	 }
	 x.open('POST', 'save.php')
	 x.setRequestHeader('Content-type',
			    'application/x-www-form-urlencoded')
	 x.send(`txt=${encodeURIComponent(txt.value)}`)
 })
</script>
<?php
require_once("../script/php/footer.php");
?>
