<?php
require_once("../../../script/php/constants.php");
require_once("../../../script/php/colors.php");
require_once("../../../script/php/functions.php");

$title = $_TITLE . " › کۆد › بەشداربوون";
$desc = "بەشداربوون لە نووسینی کۆدەکانی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

require_once("../../../script/php/header.php");
?>
<style>
 #main-contributing code {
	 direction:ltr;
	 text-align:left;
	 font-family:"kurd", monospace;
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
	 margin:1em auto;
	 max-width:100%;
	 cursor:pointer;
 }
 #main-contributing .material-icons {
	 display:inline;
	 font-size:1.5em;
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
	<div id="main-contributing"
	     style="font-size:.6em;text-align:justify;padding-right:1em">
		<?php
		const contrib_file = "CONTRIBUTING.html";
		if(file_exists(contrib_file))
			echo file_get_contents(contrib_file);
		?>
	</div>
	<h1 class="color-blue" style="font-size:1em">
		پرسیار و وەڵام
	</h1>
	<div id="frm-contributing" style="padding-right:1em">
		<small style="font-size:.6em;display:block">
			ئەگەر سەبارەت بەم بابەتە پرسیارێک‌تان هەیە لێرە بینووسن.
			<br>
			بۆ وەرگرتنی وەڵامی پرسیارەکەتان تکایە سەردانی ئەم لاپەڕە بکەنەوە.
		</small>
		<form id="frmQA" action="save.php" method="POST">
			<div style="text-align:center;font-size:.55em">
				ئەگەر لە پرسیارەکەتان‌ کۆدی تێدایە
				<button type="button"
					id="make-code"
					class="button"
					style="display:inline-block;
					      padding:.5em;
					      font-size:.8em;
					      cursor:pointer;
					      font-weight:bold;
					      font-family:monospace">
					Code
				</button>
				بەکار بێنن.
			</div>
			<textarea id="QAtxt"></textarea>
			<div id="QAres"></div>
			<button type="submit" class="button btn">ناردن</button>
		</form>
		<div>
			<?php
			const QA_path = "QA.txt";
			if(file_exists(QA_path) and filesize(QA_path) > 0) {
				$cc = file_get_contents(QA_path);
				$cc = explode("\nend\n", $cc);
				foreach($cc as $c) {
					if(empty($c))
						continue;
					$c = preg_replace(
						["/\[code\]\n*/",
						 "/\n*\[\/code\]/"],
						["<code class='bash'>",
						 "</code>"],
						$c);
					$c = str_replace(["\n"], ["<br>"], $c);
					echo "<div class='comment'>" .
					     "<div class='comm-body'>" .
					     $c . "</div></div>";
				}
			}
			?>
		</div>
	</div>    
</div>
<script>
 document.getElementById('frmQA').addEventListener('submit', e => {
	 const txt = document.getElementById('QAtxt'),
	       t = document.getElementById('QAres'),
	       loader = '<div class="loader"></div>'
	 
	 e.preventDefault()
	 
	 if(!txt.value) {
		 txt.focus()
		 return
	 }
	 
	 t.innerHTML = loader
	 
	 const x = new XMLHttpRequest
	 x.onload = () => {
		 if(x.responseText != '1')
			 return
		 t.innerHTML = '<span style="background:' +
			       'rgba(0, 255, 0, .08);color:green;' +
			       'display:block;padding:1em;font-size:.6em">' +
			       'زۆر سپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان ' +
			       'سەردانی ئەم لاپەڕە بکەنەوە.</span>'
	 }
	 x.open('post', 'save.php')
	 x.setRequestHeader('Content-type',
			    'application/x-www-form-urlencoded')
	 x.send(`txt=${encodeURIComponent(txt.value)}`)
 })
 
 document.getElementById('make-code').addEventListener('click', make_code)
 
 function make_code() {
	 const inp = document.getElementById('QAtxt'),
	       start = inp.selectionStart,
	       end = inp.selectionEnd,
	       sel = inp.value.substring(start, end)
	 if(sel || !inp.value) {
		 inp.value = inp.value.substring(0, start) +
			     `[code]${sel}[/code]` +
			     inp.value.substr(end)
	 }
	 else {
		 inp.value += '[code][/code]'
	 }	 
	 inp.style.direction = 'ltr'
	 inp.style.textAlign = 'left'
	 inp.focus()
 }
</script>
<?php
require_once("../../../script/php/footer.php");
?>
