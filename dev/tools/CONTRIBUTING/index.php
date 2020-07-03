<?php
include_once("../../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; کۆد &rsaquo; بەشداربوون";
$desc = "ئاڵەکۆک - کۆد - بەشداربوون";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<style>
 #main-contributing code {
	 direction:ltr;
	 text-align:left;
	 font-family:'kurd', monospace;
	 padding:0 .3em;
	 margin:0 .3em;
 }
 #main-contributing code.bash {
	 display:block;
	 border-left:2px solid;
	 word-wrap:break-word;
	 text-indent:0;
	 padding:1em;
	 margin:.5em 0;
 }
 #main-contributing pre {
	 overflow:auto;
 }
 #main-contributing pre code {
	 overflow:auto;
	 font-size:.85em;
	 word-spacing:5px;
 }
 #main-contributing ul, ol {
	 padding-right:2em;
	 list-style-type:arabic-indic;
	 font-size:.9em
 }
 #main-contributing img {
	 display:block;
	 margin: 1em auto;
	 max-width:100%;
	 cursor:pointer;
 }
 #main-contributing .material-icons {
	 display: inline;
	 font-size: 1.5em;
 }
</style>
<div id="poets" style="text-align:right">
	<h1 style="font-size:1em">
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
	<div id="main-contributing" style="font-size:.6em;
		 text-align:justify;padding-right:1em">
		<?php
		@include('CONTRIBUTING.html');
		?>
	</div>
	<script>
	 function make_code() {
		 var inp = document.querySelector("#QAtxt");
		 var start = inp.selectionStart;
		 var end = inp.selectionEnd;
		 var sel = inp.value.substring(start,end)
		 if(sel != "" || inp.value == "") {
			 
			 var out = "[code]" + sel + "[/code]";
			 
			 var part1 = inp.value.substring(0, start);
			 var part2 = inp.value.substr(end);
			 
			 out = part1 + out + part2;
			 
			 inp.value = out;
		 } else {
			 inp.value += "[code][/code]";
		 }
		 
		 inp.style.direction="ltr";
		 inp.style.textAlign="left";
		 inp.focus();
	 }
	</script>

	<h1 class='color-blue' style="font-size:1em">
		پرسیار و وەڵام
	</h1>
	<div id="frm-contributing" style="padding-right:1em">
		<small style="font-size:.6em;display:block">
			ئەگەر سەبارەت بەم بابەتە پرسیارێک‌و هەیە لێرە بینووسن.
			<br>
			بۆ وەرگرتنی وەڵامی پرسیارەکەتان سەردانی ئەم لاپەڕە بکەنەوە.
		</small>
		<form id="frmQA" action="save.php" method="POST">
			<div style='text-align:center'>
				<button type="button" class='back-blue color-white' style="display:inline-block;padding:.7em;font-size:.45em;cursor:pointer;margin:0 auto 5px 10px;font-weight:bold;font-family:monospace;" onclick="make_code()">Code</button><span style="font-size:.55em">ئەگەر کۆدی تێدایە لە پرسیارەکەتان تکایە "Code" بەکار بێنن.
				</span>
			</div>
			<textarea id="QAtxt"></textarea>
			<div id="QAres"></div>
			<button type="submit" class='button btn'>ناردن</button>
		</form>
		
		<div>
			<?php
			if(@filesize("QA.txt") > 0) {
				
				$f = fopen("QA.txt", "r");
				$cc = fread($f, filesize("QA.txt"));
				$cc = explode("\nend\n", $cc);
				
				foreach($cc as $c) {
					if(!empty($c)) {
						$c = preg_replace(
							["/\[code\]\n*/","/\n*\[\/code\]/"],
							["<code class='bash'>","</code>"], $c);
						$c = str_replace(["\n"], ["<br>"], $c);
						echo "<div class='comment'><div class='comm-body'>".$c."</div></div>";
					}
				}
				
				fclose($f);
			}
			
			?>
		</div>
		
		<script>
		 
		 document.querySelector("#frmQA").addEventListener("submit", function(e) {
			 e.preventDefault();
			 
			 const txt = document.querySelector("#QAtxt"),
			       t = document.querySelector("#QAres"),
			       loader = "<div class='loader'></div>";
			 
			 if(txt.value == "")
			 {
				 txt.focus();
				 return;
			 }
			 
			 t.innerHTML = loader;
			 
			 const x = new XMLHttpRequest();
			 x.onload = function() {
				 if(this.responseText == "1") {
					 t.innerHTML = "<span style='background:rgba(0,255,0,.08); color:green; display:block;padding:1em; font-size:.6em;'>زۆرسپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</span>";
				 }
			 }
			 x.open("POST", "save.php");
			 x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			 x.send(`txt=${encodeURIComponent(txt.value)}`);
		 });
		</script>        
	</div>    
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
