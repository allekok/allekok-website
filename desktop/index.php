<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; بەرنامەی دێسکتاپی ئاڵەکۆک";
$desc = "داگرتنی بەرنامەی دێسکتاپی ئاڵەکۆک بۆ ویندۆز و لینوکس";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>
<div id="poets" style="max-width:850px">
    <h1 style="padding:.1em .8em 0;border-radius:5px;
	       font-size:1.2em">
        بەرنامەی دێسکتاپی ئاڵەکۆک
    </h1>
    <style>
     .pitewsec {
	 font-size:1.2em
     }
     #QAtxt {
         font-size: .65em;
         text-align: right;
         max-width: 90%;
         width: 90%;
         min-height: 8em;
         display: block;
         margin: 1em auto 0;
         height: 155px;
     }
     .btn {
         font-size: .65em;
         width: 50%;
         padding: .8em 0;
         max-width: 150px;
         margin-top: 1em;
     }
    </style>
    <section class='pitewsec'>
        <svg style="fill:#0078d7;width:60%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 93.7l183.6-25.3v177.4H0V93.7zm0 324.6l183.6 25.3V268.4H0v149.9zm203.8 28L448 480V268.4H203.8v177.9zm0-380.6v180.1H448V32L203.8 65.7z"/></svg>
        <h3>
            <small>
                <a class="border-bottom-eee" href="https://allekok.github.io/allekok-downloads/downloads/allekok-desktop/allekok-latest.exe"><i style="font-size:1.15em;display:inline;vertical-align:middle" class="material-icons">cloud_download</i> دابەزاندن بۆ ویندۆز
                </a>
		<small style='font-size:.7em;display:block;'>
                    وەشانی ۱.۰.۰
		</small>
                <a target="_blank" rel="noopener noreferrer nofollow" href="https://github.com/allekok/allekok-desktop/releases/tag/v1.0.0" style="color:inherit;font-size:.9em;margin-top:1em;display:inline-block">
                    وەشانەکانی تر...
                </a>
            </small>
        </h3>
    </section><section class='pitewsec'>
        <svg style="width:60%;fill:#666" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M196.1 123.6c-.2-1.4 1.9-2.3 3.2-2.9 1.7-.7 3.9-1 5.5-.1.4.2.8.7.6 1.1-.4 1.2-2.4 1-3.5 1.6-1 .5-1.8 1.7-3 1.7-1 .1-2.7-.4-2.8-1.4zm24.7-.3c1 .5 1.8 1.7 3 1.7 1.1 0 2.8-.4 2.9-1.5.2-1.4-1.9-2.3-3.2-2.9-1.7-.7-3.9-1-5.5-.1-.4.2-.8.7-.6 1.1.3 1.3 2.3 1.1 3.4 1.7zm214.7 310.2c-.5 8.2-6.5 13.8-13.9 18.3-14.9 9-37.3 15.8-50.9 32.2l-2.6-2.2 2.6 2.2c-14.2 16.9-31.7 26.6-48.3 27.9-16.5 1.3-32-6.3-40.3-23v-.1c-1.1-2.1-1.9-4.4-2.5-6.7-21.5 1.2-40.2-5.3-55.1-4.1-22 1.2-35.8 6.5-48.3 6.6-4.8 10.6-14.3 17.6-25.9 20.2-16 3.7-36.1 0-55.9-10.4l1.6-3-1.6 3c-18.5-9.8-42-8.9-59.3-12.5-8.7-1.8-16.3-5-20.1-12.3-3.7-7.3-3-17.3 2.2-31.7 1.7-5.1.4-12.7-.8-20.8-.6-3.9-1.2-7.9-1.2-11.8 0-4.3.7-8.5 2.8-12.4 4.5-8.5 11.8-12.1 18.5-14.5 6.7-2.4 12.8-4 17-8.3 5.2-5.5 10.1-14.4 16.6-20.2-2.6-17.2.2-35.4 6.2-53.3 12.6-37.9 39.2-74.2 58.1-96.7 16.1-22.9 20.8-41.3 22.5-64.7C158 103.4 132.4-.2 234.8 0c80.9.1 76.3 85.4 75.8 131.3-.3 30.1 16.3 50.5 33.4 72 15.2 18 35.1 44.3 46.5 74.4 9.3 24.6 12.9 51.8 3.7 79.1 1.4.5 2.8 1.2 4.1 2 1.4.8 2.7 1.8 4 2.9 6.6 5.6 8.7 14.3 10.5 22.4 1.9 8.1 3.6 15.7 7.2 19.7 11.1 12.4 15.9 21.5 15.5 29.7zM220.8 109.1c3.6.9 8.9 2.4 13 4.4-2.1-12.2 4.5-23.5 11.8-23 8.9.3 13.9 15.5 9.1 27.3-.8 1.9-2.8 3.4-3.9 4.6 6.7 2.3 11 4.1 12.6 4.9 7.9-9.5 10.8-26.2 4.3-40.4-9.8-21.4-34.2-21.8-44 .4-3.2 7.2-3.9 14.9-2.9 21.8zm-46.2 18.8c7.8-5.7 6.9-4.7 5.9-5.5-8-6.9-6.6-27.4 1.8-28.1 6.3-.5 10.8 10.7 9.6 19.6 3.1-2.1 6.7-3.6 10.2-4.6 1.7-19.3-9-33.5-19.1-33.5-18.9 0-24 37.5-8.4 52.1zm-9.4 20.9c1.5 4.9 6.1 10.5 14.7 15.3 7.8 4.6 12 11.5 20 15 2.6 1.1 5.7 1.9 9.6 2.1 18.4 1.1 27.1-11.3 38.2-14.9 11.7-3.7 20.1-11 22.7-18.1 3.2-8.5-2.1-14.7-10.5-18.2-11.3-4.9-16.3-5.2-22.6-9.3-10.3-6.6-18.8-8.9-25.9-8.9-14.4 0-23.2 9.8-27.9 14.2-.5.5-7.9 5.9-14.1 10.5-4.2 3.3-5.6 7.4-4.2 12.3zm-33.5 252.8L112.1 366c-6.8-9.2-13.8-14.8-21.9-16-7.7-1.2-12.6 1.4-17.7 6.9-4.8 5.1-8.8 12.3-14.3 18-7.8 6.5-9.3 6.2-19.6 9.9-6.3 2.2-11.3 4.6-14.8 11.3-2.7 5-2.1 12.2-.9 20 1.2 7.9 3 16.3.6 23.9v.2c-5 13.7-5 21.7-2.6 26.4 7.9 15.4 46.6 6.1 76.5 21.9 31.4 16.4 72.6 17.1 75.3-18 2.1-20.5-31.5-49-41-68.9zm153.9 35.8c3.2-11 6.3-21.3 6.8-29 .8-15.2 1.6-28.7 4.4-39.9 3.1-12.6 9.3-23.1 21.4-27.3 2.3-21.1 18.7-21.1 38.3-12.5 18.9 8.5 26 16 22.8 26.1 1 0 2-.1 4.2 0 5.2-16.9-14.3-28-30.7-34.8 2.9-12 2.4-24.1-.4-35.7-6-25.3-22.6-47.8-35.2-59-2.3-.1-2.1 1.9 2.6 6.5 11.6 10.7 37.1 49.2 23.3 84.9-3.9-1-7.6-1.5-10.9-1.4-5.3-29.1-17.5-53.2-23.6-64.6-11.5-21.4-29.5-65.3-37.2-95.7-4.5 6.4-12.4 11.9-22.3 15-4.7 1.5-9.7 5.5-15.9 9-13.9 8-30 8.8-42.4-1.2-4.5-3.6-8-7.6-12.6-10.3-1.6-.9-5.1-3.3-6.2-4.1-2 37.8-27.3 85.3-39.3 112.7-8.3 19.7-13.2 40.8-13.8 61.5-21.8-29.1-5.9-66.3 2.6-82.4 9.5-17.6 11-22.5 8.7-20.8-8.6 14-22 36.3-27.2 59.2-2.7 11.9-3.2 24 .3 35.2 3.5 11.2 11.1 21.5 24.6 29.9 0 0 24.8 14.3 38.3 32.5 7.4 10 9.7 18.7 7.4 24.9-2.5 6.7-9.6 8.9-16.7 8.9 4.8 6 10.3 13 14.4 19.6 37.6 25.7 82.2 15.7 114.3-7.2zM415 408.5c-10-11.3-7.2-33.1-17.1-41.6-6.9-6-13.6-5.4-22.6-5.1-7.7 8.8-25.8 19.6-38.4 16.3-11.5-2.9-18-16.3-18.8-29.5-.3.2-.7.3-1 .5-7.1 3.9-11.1 10.8-13.7 21.1-2.5 10.2-3.4 23.5-4.2 38.7-.7 11.8-6.2 26.4-9.9 40.6-3.5 13.2-5.8 25.2-1.1 36.3 7.2 14.5 19.5 20.4 33.7 19.3 14.2-1.1 30.4-9.8 43.6-25.5 22-26.6 62.3-29.7 63.2-46.5.3-5.1-3.1-13-13.7-24.6zM173.3 148.7c2 1.9 4.7 4.5 8 7.1 6.6 5.2 15.8 10.6 27.3 10.6 11.6 0 22.5-5.9 31.8-10.8 4.9-2.6 10.9-7 14.8-10.4 3.9-3.4 5.9-6.3 3.1-6.6-2.8-.3-2.6 2.6-6 5.1-4.4 3.2-9.7 7.4-13.9 9.8-7.4 4.2-19.5 10.2-29.9 10.2-10.4 0-18.7-4.8-24.9-9.7-3.1-2.5-5.7-5-7.7-6.9-1.5-1.4-1.9-4.6-4.3-4.9-1.4-.1-1.8 3.7 1.7 6.5z"/></svg>
        <h3>
            <small>
                <a class="border-bottom-eee" href="https://allekok.github.io/allekok-downloads/downloads/allekok-desktop/allekok-latest.AppImage"><i style="font-size:1.15em;display:inline;vertical-align:middle" class="material-icons">cloud_download</i> دابەزاندن بۆ لینوکس
                </a>
		<small style='font-size:.7em;display:block'>
                    وەشانی ۱.۲.۲
		</small>
                <a target="_blank" rel="noopener noreferrer nofollow" href="https://github.com/allekok/allekok-desktop/releases/" style="color:inherit;font-size:.9em;display:inline-block;margin-top:1em">
                    وەشانەکانی تر...
                </a>
            </small>
        </h3>
    </section>
    
    <br><a target="_blank" rel="noopener noreferrer nofollow"
	   href="https://github.com/allekok/allekok-desktop"
	   style="display:inline-block"
	><img src="/style/img/github.svg"
	      style="width:2em;padding:.1em;background:#fff;border-radius:50%"></a>
    
    <div class="border-eee" style="margin:1em 0 .8em"></div>
    
    <div style="max-width:800px; margin:auto; padding:0 .2em;">
        <h3 style="font-size: .7em;">
            بیروڕای خۆتان سەبارەت بە بەرنامەی دێسکتاپی ئاڵەکۆک لێرە بنووسن.
        </h3>
        <form id="frmQA" action="save.php" method="POST">
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
                
                echo "<h3 style='border-top: 1px solid #eee;margin-top: 2em;font-size: .7em;padding: 1em;'>بیر و بۆچوونەکان</h3>";
                
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
