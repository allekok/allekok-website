<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; چۆنیەتی بەکارهێنانی ئاڵەکۆک";
$desc = "ڕێنوومایی چۆنیەتی بەکارهێنانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>

<div id="poets" style="max-width:850px">

    <h1 style="display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0 0;font-size:1.2em;color: #555;">
        <i class='material-icons' style='font-size:inherit; vertical-align:middle;color:<?php echo $colors[0][0]; ?>;'>help</i>
        چۆنیەتی بەکارهێنانی ئاڵەکۆک
    </h1>
    <style>
     #QAtxt {
         font-size: 0.65em;
         padding: 0.6em 3% 0.6em 2%;
         text-align: right;
         max-width: 90%;
         width: 90%;
         min-height: 8em;
         display: block;
         border-top: 3px solid rgb(221, 221, 221);
         box-shadow: rgb(221, 221, 221) 0px 5px 10px -5px;
         box-sizing: border-box;            
         margin: 1em auto 0;
         height: 155px;
     }
     .btn {
         font-size: 0.65em;
         width: 50%;
         padding: 0.8em 0;
         max-width: 150px;
         cursor: pointer;
         margin-top: 0.5em;
     }
     main pre {
         white-space: pre-wrap;       /* Since CSS 2.1 */
         white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
         white-space: -pre-wrap;      /* Opera 4-6 */
         white-space: -o-pre-wrap;    /* Opera 7 */
         word-wrap: break-word;       /* Internet Explorer 5.5+ */
         font-family: inherit;
     }
     code {
         direction:ltr;
         background:#f3f3f3;
         color:#333;
         text-align:left;
         display:block;
         border-left:10px solid #ddd;
         word-wrap:break-word;
         text-indent:0;
         padding:1em;
         font-family:'kurd', monospace;
         letter-spacing:1px;
         margin:.5em 0;
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
         color:#333;
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
         vertical-align: middle;
         font-size: 1.5em;
     }
    </style>
    
    <main style="font-size:.65em;text-align:justify;padding:1em;">
	<?php
	echo file_get_contents("manual.html");
	?>
    </main>
    
    <script>
     window.onload = function() {
	 var imgs = document.querySelector("main").querySelectorAll("img");
	 imgs.forEach( function (e) {
             e.onclick = function() {
		 window.location = e.src;
             } 
	 });
     }
    </script>
    
    <div style="border-top:1px solid #ddd;margin:1em 0 0.8em;"></div>
    
    <div style="max-width:800px; margin:auto; padding:0 .2em;">
        <h3 style="font-size: .7em;">
            ئەگەر پرسیارێک‌و سەبارەت بە "چۆنیەتی بەکارهێنانی ئاڵەکۆک" هەیە دەتوانن لێرە بیپرسن.
        </h3>
        <small style="color:#555; font-size:.5em; display:block;">
            بۆ وەرگرتنی وەڵامی پرسیارەکەتان، سەردانی ئەم لاپەڕە بکەنەوە.
        </small>
        <form id="frmQA" action="save.php" method="POST">
            <textarea id="QAtxt" placeholder="پرسیارەکەو لێرە بنووسن..."></textarea>
            <div id="QAres"></div>
            <button type="submit" class='button btn'>ناردن</button>
        </form>
        
        <div>
            <?php
            if(filesize("QA.txt") > 0) {
                
                $f = fopen("QA.txt", "r");
                $cc = fread($f, filesize("QA.txt"));
                $cc = explode("\nend\n", $cc);
                
                echo "<h3 style='border-top: 1px solid #ddd;margin-top: 2em;font-size: .7em;padding: 1em;'>پرسیار و وەڵامەکان</h3>";
                
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
        
        <script>
         
         document.querySelector("#frmQA").addEventListener("submit", function(e) {
             e.preventDefault();
             
             var txt = document.querySelector("#QAtxt");
             var t = document.querySelector("#QAres");
             var loader = "<div class='loader'></div>";
             
             if(txt.value == "") {
                 txt.focus();
                 return;
             }
             
             t.innerHTML = loader;
             
             var x = new XMLHttpRequest();
             x.onload = function() {
                 if(this.responseText == "1") {
                     t.innerHTML = "<span style='background:rgba(0,255,0,.08); color:green;display:block;padding:1em; font-size:.6em;'>زۆرسپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</span>";
                     txt.value = "";
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
