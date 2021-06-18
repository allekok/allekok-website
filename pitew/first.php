<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک";
$desc = "نووسینی شیعر، ناردنی وێنەی شاعیرانی، نووسینی زانیاری سەبارەت بە شاعیران و پەراوێزەکان";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 .pitewsec-first small {
	 display:block;
	 text-align:justify;
 }
</style>
<div id="poets" style="text-align:right">
	<h1 class="color-blue" style="text-align:right;
		   font-size:1em">
		پتەوکردن
	</h1>
	<div style="padding-right:1em">
		<section class="pitewsec pitewsec-first">
			<a href="index.php">
				<i class="material-icons">note_add</i>
				<h3>
					نووسینی شیعر
				</h3>
				<br>
				<small>
					ئەگەر دەتانهەوێ لە نووسینەوەی شیعرەکان‌دا
					یارمەتی‌مان بدەن، لێرە کرتە بکەن. ئەگەر
					دەقی شیعرێک‌تان لە لایە کە لە سەر ئاڵەکۆک
					نییە، تکایە لێرە کرتە بکەن و بۆمانی
					بنێرن، تا دوای پێداچوونەوە بە نێوی خۆتان
					لەسەر ئاڵەکۆک دابندرێ.
					<br>
				</small>
			</a>
			<small>
				دەتوانن بۆ نووسینەوەی شیعر لەم دیوانانە کەڵک وەرگرن:
				<a class="link-underline"
				   style="display:inline-block"
				   href="pdfs.php">
					داگرتنی دیوانی شاعیران
				</a>
			</small>
		</section><section class="pitewsec pitewsec-first">
			<a href="poet-image.php">
				<i class="material-icons">image</i>
				<h3>
					ناردنی وێنەی شاعیران
				</h3>
				<br>
				<small>
					ئەگەر وێنەی هەر کام لە شاعیران‌تان لە
					لایە تکایە لێرە کرتە بکەن و بۆمانی
					بنێرن. ئەم وێنەی کە بۆمان دەنێرن دەبێتە
					بەشێک لە ئاڵەکۆک.
				</small>
			</a>
		</section><section class="pitewsec pitewsec-first">
			<a href="edit-poet.php">
				<i class="material-icons">person</i>
				<h3>
					نووسینی زانیاری سەبارەت بە شاعیران
				</h3>
				<br>
				<small>
					ئەگەر زانیاری زیاترتان سەبارەت بە هەر یەک لە
					شاعیران هەیە دەتوانن لێرە کرتە بکەن و بینووسن.
					هەروەها ئەگەر هەڵەیەک لە زانیارییەکانی ئاڵەکۆک
					سەبارەت بە هەرکام لە شاعیران دەبینن، دەتوانن
					بە کرتە کردن لێرە بۆمان بنووسن، تا پێداچوونەوەی
					بەسەردا بکەیین.
				</small>
			</a>
		</section><section class="pitewsec pitewsec-first">
			<a href="<?php echo _R; ?>comments/">
				<i class="material-icons">question_answer</i>
				<h3>
					ڕاست‌کردنەوەی هەڵەکانی ناو شیعر
				</h3>
				<br>
				<small>
					ئەگەر هەڵەیەک لە ناو هەر یەک لە شیعرەکان‌دا
					بەدی دەکەن دەتوانن لە ژێر ئەو شیعرە لە بەشی
					نووسینی پەراوێزدا، ڕەخنەکەتان بنووسن تا لە
					زووترین کات‌دا پێداچوونەوەی بەسەردا بکرێت.
				</small>
			</a>
		</section></section><section class="pitewsec pitewsec-first">
			<a href="<?php echo _R; ?>about">
				<i class="material-icons"
				><img src="<?php echo _R;
					   ?>style/img/logo/logo-64.jpg"
				      style="border:2px solid;
					   border-radius:50%;
					   padding:.02em;width:.9em;
					   margin-bottom:.1em"></i>
				<h3>
					ئاڵەکۆک؟
				</h3>
				<br>
				<small>
					ئەگەر کێشەیەک لە کاری ئاڵەکۆک‌دا هەیە یان
					پێشنیارێک‌تان بۆ چاکتر بوونی ئاڵەکۆک هەیە،
					تکایە لێرە کرتە بکەن و لە بەشی
					"ئاڵەکۆک‌تان بەلاوە چۆنە؟" بۆمان بنووسن.
				</small>
			</a>
		</section>
	</div>
	
	<h3 class="color-blue" style="font-size:1em;text-align:right">
		پرسیار و وەڵام
	</h3>
	<div style="padding-right:1em">
		<small style="font-size:.55em;display:block">
			ئەگەر پرسیارێک‌تان سەبارەت بە "پتەوکردنی ئاڵەکۆک" هەیە،
			دەتوانن لێرە بیپرسن.
			<br>
			بۆ وەرگرتنی وەڵامی پرسیارەکەتان، سەردانی ئەم لاپەڕە بکەنەوە.
		</small>
		<form id="frmQA" action="save.php" method="POST">
			<textarea id="QAtxt" class="QAtxt-first"
				  placeholder="پرسیارەکەتان لێرە بنووسن..."
			></textarea>
			<div id="QAres"></div>
			<button type="submit" class="button btn-first"
			>ناردن</button>
		</form>
		
		<div>
			<?php
			if(@filesize("QA.txt") > 0) {
				$cc = file_get_contents("QA.txt");
				$cc = explode("\nend\n", $cc);
				$cc = array_reverse($cc);
				$i = 1;
				foreach($cc as $c) {
					$c = trim($c);
					if($c) {
						$c = preg_replace(
							["/\[code\]\n*/",
							 "/\n*\[\/code\]/"],
							["<code>",
							 "</code>"],
							$c);
						$c = str_replace("\n",
								 "<br>",
								 $c);
						echo "<div class='comment'";
						echo "><div ";
						if($i % 2) {
							echo "style='border-";
							echo "left:2px solid";
							echo ";border-right:";
							echo "0' ";
						}
						echo "class='comm-body'>" .
						     $c . "</div></div>";
						$i++;
					}
				}
			}
			?>
		</div>
		
		<script>
		 document.getElementById("frmQA").addEventListener("submit",e=>{
			 const loader = "<div class='loader'></div>",
			       txt = document.getElementById("QAtxt"),
			       v = txt.value.trim(),
			       t = document.getElementById("QAres"),
			       x = new XMLHttpRequest()

			 e.preventDefault()
			 if(!v) {
				 txt.focus()
				 return
			 }
			 t.innerHTML = loader
			 x.onload = () => {
				 if(x.responseText == "1") {
					 t.innerHTML = "<p class='color-blue'\
 style='padding-top:1em;font-size:.6em;text-align:justify'>\
زۆر سپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</p>"
					 txt.value = ""
				 }
			 }
			 x.open("POST", "save-comment.php")
			 x.setRequestHeader(
				 "Content-type",
				 "application/x-www-form-urlencoded")
			 x.send(`txt=${encodeURIComponent(v)}`)
		 })
		</script>
	</div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
