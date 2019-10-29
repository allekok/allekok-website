<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; چۆنیەتی بەکارهێنانی ئاڵەکۆک";
$desc = "ڕێنوومایی چۆنیەتی بەکارهێنانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 #main-manual ul, #main-manual ol {
     padding-right:2em;
 }
 #main-manual p,#main-contributing p {
     text-indent:1em;
 }
 #main-manual img {
     display:block;
     margin:1em auto;
     max-width:100%;
     cursor:pointer;
     background:#fff;
     padding:1em 1em 0;
     border-radius:5px;
 }
 #main-manual .material-icons {
     display: inline;
     vertical-align: middle;
     font-size: 1.5em;
 }
</style>
<div id="poets" style="text-align:right">
    <main id="main-manual" style="font-size:.6em;text-align:justify">
	<?php
	echo file_get_contents("manual.html");
	?>
    </main>
    
    <script>
     window.onload = function()
     {
	 const imgs = document.querySelector("main").querySelectorAll("img");
	 imgs.forEach(function (e)
	 {
	     e.onclick = function()
	     {
		 window.location = e.src;
	     } 
	 });
     }
    </script>

    <h1 class="color-blue" style="font-size:1em;
	       padding:.5em 0 0">
	پرسیار و وەڵام
    </h1>
    <div id="frm-manual" style="padding-right:1em">
	<small style="font-size:.6em;display:block">
            ئەگەر پرسیارێک‌و سەبارەت بە "چۆنیەتی بەکارهێنانی ئاڵەکۆک" هەیە دەتوانن لێرە بیپرسن.
	    <br>
            بۆ وەرگرتنی وەڵامی پرسیارەکەتان، سەردانی ئەم لاپەڕە بکەنەوە.
	</small>
	<form id="frmQA" action="save.php" method="POST">
            <textarea id="QAtxt" placeholder="پرسیارەکەو لێرە بنووسن..."></textarea>
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
			    ["<code>","</code>"], $c);
			$c = str_replace(["\n"], ["<br>"], $c);
			echo "<div class='comment'><div class='comm-body'>".$c."</div></div>";
                    }
		}
		
		fclose($f);
            }
            
            ?>
	</div>
    </div>
    <script>
     document.querySelector("#frmQA").addEventListener("submit", function(e)
     {
         e.preventDefault();
         
         const txt = document.querySelector("#QAtxt"),
               t = document.querySelector("#QAres"),
	       loader = "<div class='loader'></div>",
	       x = new XMLHttpRequest();
         
         if(txt.value == '')
	 {
             txt.focus();
             return;
         }
         
         t.innerHTML = loader;
         postUrl('save.php', `txt=${encodeURIComponent(txt.value)}`, function(response)
	 {
             if(response == "1")
	     {
                 t.innerHTML = "<i style='background:rgba(0,255,0,.08);color:green;display:block;padding:1em;font-size:.6em'>زۆرسپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</i>";
                 txt.value = "";
             }
         });
     });
    </script>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
