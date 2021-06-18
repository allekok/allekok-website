<?php
include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; کۆد";
$desc = "ئاڵەکۆک - کۆد";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<style>
 #dev-main code {
	 direction:ltr;
	 text-align:left;
	 display:block;
	 border-left:2px solid;
	 word-wrap:break-word;
	 text-indent:0;
	 padding:1em;
	 font-family:'kurd', monospace;
	 margin:.5em 0;
 }
 #dev-main h2, #dev-main h3, #dev-main h4 {
	 text-align:right;
	 margin-top:1em;
	 color:<?php echo $_colors[2]; ?>;
 }
 #dev-main p {
	 padding-bottom:.5em;
 }
 #dev-main a {
	 margin:0;
 }
 #dev-main ul {
	 margin-right:2em
 }
 #main-dev pre {
	 overflow:auto;
 }
 #main-dev pre code {
	 overflow:auto;
	 font-size:.85em;
 }
 #main-dev ul, ol {
	 padding-right:2em;
	 list-style-type:arabic-indic;
	 font-size:.9em
 }

</style>
<div id="poets">
	<h1 style="font-size:1em;text-align:right">
		<i class="color-black">
			&lt;
		</i>
		<i class="color-blue">
			کۆدەکانی ئاڵەکۆک
		</i>
		<i class="color-black">
			/ &gt;
		</i>
	</h1>
	<div id="dev-main" style="text-align:justify;font-size:.6em">
		<?php
		echo str_replace('{_SITE}', _SITE,
				 @file_get_contents("dev.html"));
		?>
	</div>
	<h1 class='color-blue'
		   style='font-size:1em;text-align:right'>
		پرسیار و وەڵام
	</h1>
	<div style='padding-right:1em;text-align:right'>
		<small style="display:block;font-size:.6em;">
			ئەگەر سەبارەت بەم بابەتە پرسیارێک‌تان هەیە لێرە بینووسن.
			<br>
			بۆ وەرگرتنی وەڵامی پرسیارەکەتان سەردانی ئەم لاپەڕە بکەنەوە.
		</small>
		<form id="frmQA" action="save.php" method="POST">
			<div style="text-align:center;font-size:.55em">
				ئەگەر لە پرسیارەکەتان‌ کۆدی تێدایە
				<button type="button" class='button'
					style="display:inline-block;
					      padding:.5em;
					      font-size:.8em;cursor:pointer;
					      font-weight:bold;
					      font-family:monospace;"
					id="make-code"
				>Code</button>
				بەکار بێنن.
			</div>
			<textarea id="QAtxt" class="QAtxt-dev"></textarea>
			<div id="QAres"></div>
			<button type="submit" class='button btn btn-dev'>ناردن</button>
		</form>
		
		<div>
			<?php
			if(file_exists("QA.txt"))
			{
				$cc = file_get_contents("QA.txt");
				$cc = explode("\nend\n", $cc);
				$cc = array_reverse($cc);
				foreach($cc as $c)
				{
					if(!empty($c))
					{
						$c = preg_replace(
							["/\[code\]\n*/","/\n*\[\/code\]/"],
							["<code class='code-dev'>","</code>"], $c);
						$c = str_replace("\n", "<br>", $c);
						echo "<div class='comment'><div class='comm-body'>".
						     $c."</div></div>";
					}
				}
			}
			?>
		</div>
		<script>
		 document.querySelector("#frmQA").addEventListener("submit", function(e) {
			 e.preventDefault();
			 
			 const txt = document.querySelector("#QAtxt"),
			       t = document.querySelector("#QAres"),
			       loader = "<div class='loader'></div>";
			 
			 if(txt.value.trim() == "")
			 {
				 txt.focus();
				 return;
			 }
			 
			 t.innerHTML = loader;
			 
			 const x = new XMLHttpRequest();
			 x.onload = function()
			 {
				 if(this.responseText == "1")
				 {
					 t.innerHTML = "<p class='color-blue'\
 style='padding-top:1em;font-size:.6em'>\
زۆر سپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</p>";
				 }
			 }
			 x.open("POST", "save.php");
			 x.setRequestHeader("Content-type",
					    "application/x-www-form-urlencoded");
			 x.send(`txt=${encodeURIComponent(txt.value)}`);
		 });
		 
		 function make_code()
		 {
			 const inp = document.querySelector("#QAtxt"),
			       start = inp.selectionStart,
			       end = inp.selectionEnd,
			       sel = inp.value.substring(start,end);
			 if(sel != "" || inp.value == "")
			 {
				 let out = "[code]" + sel + "[/code]";
				 let part1 = inp.value.substring(0, start);
				 let part2 = inp.value.substr(end);
				 out = part1 + out + part2;
				 inp.value = out;
			 }
			 else
				 inp.value += "[code][/code]";
			 
			 inp.style.direction="ltr";
			 inp.style.textAlign="left";
			 inp.focus();
		 }
		 document.getElementById("make-code").addEventListener(
			 "click", make_code);
		</script>
	</div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
