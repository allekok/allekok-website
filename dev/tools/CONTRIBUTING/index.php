<?php
include_once("../../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; کۆد &raquo; بەشداربوون";
$desc = "ئاڵەکۆک - کۆد - بەشداربوون";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');
?>
<div id="poets" style="max-width:850px">    
    <h1 style="font-size:1.2em;padding:.1em .8em 0">
        <span style="color:<?php echo $colors[0][0]; ?>;">
	    <
	</span>
	کۆدەکانی ئاڵەکۆک
	<span style="color:<?php echo $colors[0][0]; ?>;">
	    >
	</span>
    </h1>
    <style>
     code {
	 direction:ltr;
         background:#f6f6f6;
         color:#444;
         text-align:left;
	 font-family:'kurd', monospace;
	 padding:0 .3em;
	 margin:0 .3em;
     }
     code.bash {
         display:block;
         border-left:10px solid #eee;
         word-wrap:break-word;
         text-indent:0;
         padding:1em;
         margin:.5em 0;
     }
     #QAtxt {
         font-size: 0.65em;
         text-align: right;
         max-width: 90%;
         width: 90%;
         min-height: 8em;
         display: block;
         margin: auto;
         height: 155px;
     }
     .btn {
         font-size: .7em;
         width: 50%;
         padding: .8em 0;
         max-width: 150px;
     }
     #poets a {
	 border-bottom:1px solid <?php echo $colors[0][0]; ?>;
     }
     pre {
	 overflow:auto;
     }
     pre code {
	 overflow:auto;
	 font-size:.85em;
	 word-spacing:5px;
     }
     main h1 {
         font-size:1.5em;
         color:<?php echo $colors[0][0]; ?>;
     }
     main h2 {
         font-size:1.3em;
         color:<?php echo $colors[0][0]; ?>;
         margin-top:1em;
     }
     main h3 {
         font-size:1.1em;
         color:<?php echo $colors[0][0]; ?>;
         margin-top:1em;
     }
     main h1, main h2, main h3 {
         text-align:right;
     }
     main ul, ol {
         padding-right:2em;
	 list-style-type:persian;
	 font-size:.9em
     }
     main p {
         text-indent: 1em;
     }
     main img {
         display:block;
         margin: 1em auto;
         max-width:100%;
         cursor:pointer;
     }
     main .material-icons {
         display: inline;
         font-size: 1.5em;
     }
    </style>
    <div id="main" style="font-size:.65em;text-align:justify;padding:1em;">
	<?php
	echo @file_get_contents('CONTRIBUTING.html');
	?>
    </div>
    <div class="border-eee" style="margin:.4em 0 .8em"></div>
    
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
    
    <div style="max-width:800px; margin:auto; padding:0 .2em">
        <h3 style="font-size: .7em;">
            ئەگەر سەبارەت بەم بابەتە پرسیارێک‌و هەیە لێرە بینووسن.
        </h3>
        <small style="font-size:.5em;padding-bottom: 1em;color:#444;display:block">
            بۆ وەرگرتنی وەڵامی پرسیارەکەتان سەردانی ئەم لاپەڕە بکەنەوە.
        </small>
        <form id="frmQA" action="save.php" method="POST">
            <button type="button" class='button' style="display: inline-block;padding: .7em;font-size: .45em;cursor: pointer;margin: 0 auto 5px 10px;background:<?php echo $colors[0][0]; ?>;color:#fff;font-weight:bold;font-family:monospace;" onclick="make_code()">Code</button><span style="font-size:.45em">ئەگەر کۆدی تێدایە لە پرسیارەکەتان تکایە "Code" بەکار بێنن.
            </span>
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
                
                echo "<h3 class='border-eee' style='margin-top:2em;
font-size:.7em;padding:1em'>پرسیار و وەڵامەکان</h3>";
                
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
                     t.innerHTML = "<span style='background:rgba(0,255,0,.08); color:<?php echo $colors[0][0]; ?>;display:block;padding:1em; font-size:.6em;'>زۆرسپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</span>";
                 }
             }
             x.open("POST", "save.php");
             x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
             x.send(`txt=${encodeURIComponent(txt.value)}`);
         });
	 document.querySelectorAll("main ul, main ol").forEach(
	     function(item) {
		 item.classList.add("color-333");
	     });
        </script>        
    </div>    
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
