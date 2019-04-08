<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; بەرنامەی مۆبایلی ئاڵەکۆک";
$desc = "داگرتنی بەرنامەی مۆبایلی ئاڵەکۆک بۆ ئەندرۆید";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>

<div id="poets" style="max-width:850px">

    <h1 style="display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0 0;font-size:1.2em;">
        بەرنامەی مۆبایلی ئاڵەکۆک
    </h1>
    <small style='font-size:.6em; margin-top:-.6em;display:block;'>
        وەشانی ۱.۲.۲
    </small>
    <style>
     .pitewsec a {
         color:#000;
         font-size:1.2em;
         line-height:2.8;
         border-bottom:1px solid #ccc;
     }
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
     .hr {
         border-top:3px dashed #ccc;
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
    </style>
    
    <section class='pitewsec' style="display:block;">
        <svg style="width:50%; fill:#a4c639;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M89.6 204.5v115.8c0 15.4-12.1 27.7-27.5 27.7-15.3 0-30.1-12.4-30.1-27.7V204.5c0-15.1 14.8-27.5 30.1-27.5 15.1 0 27.5 12.4 27.5 27.5zm10.8 157c0 16.4 13.2 29.6 29.6 29.6h19.9l.3 61.1c0 36.9 55.2 36.6 55.2 0v-61.1h37.2v61.1c0 36.7 55.5 36.8 55.5 0v-61.1h20.2c16.2 0 29.4-13.2 29.4-29.6V182.1H100.4v179.4zm248-189.1H99.3c0-42.8 25.6-80 63.6-99.4l-19.1-35.3c-2.8-4.9 4.3-8 6.7-3.8l19.4 35.6c34.9-15.5 75-14.7 108.3 0L297.5 34c2.5-4.3 9.5-1.1 6.7 3.8L285.1 73c37.7 19.4 63.3 56.6 63.3 99.4zm-170.7-55.5c0-5.7-4.6-10.5-10.5-10.5-5.7 0-10.2 4.8-10.2 10.5s4.6 10.5 10.2 10.5c5.9 0 10.5-4.8 10.5-10.5zm113.4 0c0-5.7-4.6-10.5-10.2-10.5-5.9 0-10.5 4.8-10.5 10.5s4.6 10.5 10.5 10.5c5.6 0 10.2-4.8 10.2-10.5zm94.8 60.1c-15.1 0-27.5 12.1-27.5 27.5v115.8c0 15.4 12.4 27.7 27.5 27.7 15.4 0 30.1-12.4 30.1-27.7V204.5c0-15.4-14.8-27.5-30.1-27.5z"/></svg>
        <h3>
            <small>
                <a style="display:block" href="https://allekok.github.io/allekok-downloads/downloads/allekok-android/allekok-latest.apk">
                    دابەزاندن بۆ ئەندرۆید
                </a>
                <small>
                    ئەندرۆیدی ۴.۱ بۆ سەرێ
                </small>
            </small>
        </h3>
    </section>
    
    <a target="_blank" rel="noopener noreferrer nofollow" href="https://github.com/allekok/allekok-android" style="display:inline-block; padding:1em;margin-top:2em;background:#eee;font-size:.8em">
        <img src="/desktop/github.svg" style="width:32px; vertical-align:middle;">
        گیت‌هاب
    </a>
    
    <div style="border-top:1px solid #ddd;margin:1em 0 0.8em;"></div>
    
    <div style="max-width:800px; margin:auto; padding:0 .2em;">
        <h3 style="font-size: .7em;">
            بیروڕای خۆتان سەبارەت بە بەرنامەی مۆبایلی ئاڵەکۆک لێرە بنووسن.
        </h3>
        <form id="frmQA" action="save.php" method="POST">
            <textarea id="QAtxt"></textarea>
            <div id="QAres"></div>
            <button type="submit" class='button btn'>ناردن</button>
        </form>
        
        <div>
            <?php
            if(filesize("QA.txt") > 0) {
                
                $f = fopen("QA.txt", "r");
                $cc = fread($f, filesize("QA.txt"));
                $cc = explode("\nend\n", $cc);
                
                echo "<h3 style='border-top: 1px solid #ddd;margin-top: 2em;font-size: .7em;padding: 1em;'>بیر و بۆچوونەکان</h3>";
                
                $cc = array_reverse($cc);
                
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
                     t.innerHTML = "<span style='background:rgba(0,255,0,.08); color:green;display:block;padding:1em; font-size:.6em;'>زۆرسپاس بۆ دەربڕینی بیروڕاتان.</span>";
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
