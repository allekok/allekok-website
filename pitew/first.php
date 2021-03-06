<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک";
$desc = "پتەوکردنی ئاڵەکۆک - چۆن دەتوانن ئاڵەکۆک دەوڵەمەندتر کەن؟";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
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
	<div style='padding-right:1em'>
		<section class='pitewsec pitewsec-first'>
			<a href="index.php">
				<i class='material-icons'>note_add</i>
				<h3>
					نووسینی شیعر
				</h3>
				<br>
				<small>
					ئەگەر دەتانهەوێ لە نووسینەوەی شیعری شاعیران‌دا یارمیتی‌مان بدەن، لێرە کرتە بکەن. ئەگەر دەقی شیعرێک‌و لەلایە کە لەسەر ئاڵەکۆک نییە، زۆر بەنرخ دەبێ ئەگەر لێرە کرتە بکەن و بۆمان بنێرن، تا دوای پێداچوونەوە بە نێوی خۆتان لەسەر ئاڵەکۆک دابندرێ.
					<br>
				</small>
				
			</a>
			<small>
				دەتوانن بۆ نووسینەوەی شیعر لەم دیوانانە کەڵک وەرگرن: <a class="link-underline" style='display:inline-block' href="pdfs.php">
				داگرتنی دیوانی شاعیران
				</a>
			</small>
		</section><section class='pitewsec pitewsec-first'>
			<a href="poet-image.php">
				<i class='material-icons'>image</i>
				<h3>
					ناردنی وێنەی شاعیران
				</h3>
				<br>
				<small>
					ئەگەر وێنەی هەریەک لەو شاعیرانەی کە لەسەر ئاڵەکۆک وێنەیان نیە لەلاتانە، یان بە تێ‌بینی خۆتان وێنەیەکی باشتری هەرکام لە شاعیران‌و لەلایە، بۆ ناردنی لێرە کرتە بکەن.
				</small>
			</a>
		</section><section class='pitewsec pitewsec-first'>
			<a href="edit-poet.php">
				<i class='material-icons'>person</i>
				<h3>
					نووسینی زانیاری سەبارەت بە شاعیران
				</h3>
				<br>
				<small>
					ئەگەر زانیاری زیاترتان سەبارەت بە هەریەک لە شاعیران هەیە دەتوانن لێرە کرتە بکەن و بینووسن. هەروەها ئەگەر هەڵەیەک لە زانیاریەکانی سەر ئاڵەکۆک سەبارەت بەهەرکام لە شاعیران دەبینن، دەتوانن بە کرتە کردن لێرە بۆمان بنووسن، تا پێداچوونەوەی بەسەردا بکەیین.
				</small>
			</a>
		</section><section class='pitewsec pitewsec-first'>
			<a href="<?php echo _R; ?>comments/">
				<i class='material-icons'>question_answer</i>
				<h3>
					ڕاست‌کردنەوەی هەڵەکانی ناو شیعر
				</h3>
				<br>
				<small>
					ئەگەر هەڵەیەک لەناو هەریەک لە شیعرەکان دا بەدی دەکەن دەتوانن لە ژێر ئەو شیعرە لە بەشی نووسینی پەراوێز دا، ڕەخنەکەتان بنووسن تا لە زووترین کات دا پێداچوونەوەی بەسەردا بکرێ.
				</small>
			</a>
		</section></section><section class='pitewsec pitewsec-first'>
			<a href="<?php echo _R; ?>about">
				<i class='material-icons'
				><img src='<?php echo _R; ?>style/img/logo/logo-64.jpg'
				      style='border:2px solid;
					   border-radius:50%;
					   padding:.02em;width:.9em;
					   margin-bottom:.1em'></i>
				<h3>
					ئاڵەکۆک؟
				</h3>
				<br>
				<small>
					ئەگەر کێشەیەک لە کاری ئاڵەکۆک دا هەیە یان پێشنیارێک‌و بۆ چاکتر بوونی ئاڵەکۆک هەیە، تکایە لێرە کرتە بکەن و لەبەشی "ئاڵەکۆک‌تان بەلاوە چۆنە؟" بۆمان بنووسن.
				</small>
			</a>
		</section>
	</div>
	
	<h3 class="color-blue" style="font-size:1em;
		   text-align:right">
		پرسیار و وەڵام
	</h3>
	<div style="padding-right:1em">
		<small style="font-size:.55em;display:block">
			ئەگەر پرسیارێک‌و سەبارەت بە "پتەوکردنی ئاڵەکۆک" هەیە، دەتوانن لێرە بیپرسن.
			<br>
			بۆ وەرگرتنی وەڵامی پرسیارەکەتان، سەردانی ئەم لاپەڕە بکەنەوە.
		</small>
		<form id="frmQA" action="save.php" method="POST">
			<textarea id="QAtxt" class="QAtxt-first"
				  placeholder="پرسیارەکەو لێرە بنووسن..."></textarea>
			<div id="QAres"></div>
			<button type="submit" class='button btn-first'>ناردن</button>
		</form>
		
		<div>
			<?php
			if(@filesize("QA.txt") > 0)
			{
				$cc = file_get_contents("QA.txt");
				$cc = explode("\nend\n", $cc);
				
				$cc = array_reverse($cc);
				$i = 1;
				foreach ($cc as $c)
				{
					$c = trim($c);
					if($c)
					{
						$c = preg_replace(
							["/\[code\]\n*/","/\n*\[\/code\]/"],
							["<code>","</code>"], $c);
						$c = str_replace("\n", "<br>", $c);
						echo "<div class='comment'";
						echo "><div ";
						if($i%2)
							echo "style='border-left:2px solid;border-right:0' ";
						echo "class='comm-body'>".$c."</div></div>";
						$i++;
					}
				}
			}
			?>
		</div>
		
		<script>         
		 document.getElementById("frmQA").addEventListener("submit", function(e)
			 {
				 e.preventDefault();
				 
				 const txt = document.getElementById("QAtxt"),
				       t = document.getElementById("QAres"),
				       loader = "<div class='loader'></div>",
				       x = new XMLHttpRequest();
				 
				 if(txt.value == "")
				 {
					 txt.focus();
					 return;
				 }
				 
				 t.innerHTML = loader;
				 
				 x.onload = function ()
				 {
					 if(this.responseText == "1")
					 {
						 t.innerHTML = "<span style='background:rgba(0,255,0,.08);color:green;display:block;\
padding:1em;font-size:.6em'>زۆرسپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</span>";
						 txt.value = "";
					 }
				 }
				 x.open("POST", "save-comment.php");
				 x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				 x.send(`txt=${encodeURIComponent(txt.value)}`);
		 });
		</script>
	</div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
