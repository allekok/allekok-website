<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک";
$desc = "پتەوکردنی ئاڵەکۆک - چۆن دەتوانن ئاڵەکۆک دەوڵەمەندتر کەن؟";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');
?>

<div id="poets" style="max-width:1000px">
    
    <h1 style="color: #222;display: inline-block;margin: 1em 0;font-size: 1.2em;">
        <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> 
        پتەوکردنی ئاڵەکۆک
    </h1>
    <br>
    <section class='pitewsec'>
        <a href="index.php">
            <i class='material-icons'>note_add</i>
            <h3>
                نووسینی شێعر
                <br>
                <small>
                    ئەگەر دەتوانهەوێ لە نووسینەوەی شێعری شاعیران‌دا یارمیتی‌مان بدەن، لێرە کرتە بکەن. ئەگەر دەقی شێعرێک‌و لەلایە کە لەسەر ئاڵەکۆک نییە، زۆر بەنرخ دەبێ ئەگەر لێرە کرتە بکەن و بۆمان بنێرن، تا دوای پێداچوونەوە بە نێوی خۆتان لەسەر ئاڵەکۆک دابندرێ.
                    <br>
                    دەتوانن بۆ نووسینەوەی شێعر لەم دیوانانە کەڵک وەرگرن:
	</a>

        <a style='border-bottom:1px solid <?php echo $colors[0][0]; ?>;display:inline-block;color:#222;' href="/pitew/pdfs.php">
	    داگرتنی دیوانی شاعیران
        </a>
                </small>
            </h3>
    </section><section class='pitewsec'>
        <a href="poet-image.php">
            <i class='material-icons'>image</i>
            <h3>
                ناردنی وێنەی شاعیران
                <br>
                <small>
                    ئەگەر وێنەی هەریەک لەو شاعیرانەی کە لەسەر ئاڵەکۆک وێنەیان نیە لەلاتانە، یان بە تێ‌بینی خۆتان وێنەیەکی باشتری هەرکام لە شاعیران‌و لەلایە، بۆ ناردنی لێرە کرتە بکەن.
                </small>
            </h3>
        </a>
    </section><section class='pitewsec'>
        <a href="edit-poet.php">
            <i class='material-icons'>person</i>
            <h3>
                نووسینی زانیاری سەبارەت بە شاعیران
                <br>
                <small>
                    ئەگەر زانیاری زیاترتان سەبارەت بە هەریەک لە شاعیران هەیە دەتوانن لێرە کرتە بکەن و بینووسن. هەروەها ئەگەر هەڵەیەک لە زانیاریەکانی سەر ئاڵەکۆک سەبارەت بەهەرکام لە شاعیران دەبینن، دەتوانن بە کرتە کردن لێرە بۆمان بنووسن، تا پێداچوونەوەی بەسەردا بکەیین.
                </small>
            </h3>
        </a>
    </section><section class='pitewsec'>
        <a href="/comments/">
            <i class='material-icons'>question_answer</i>
            <h3>
                ڕاست‌کردنەوەی هەڵەکانی ناو شێعر
                <br>
                <small>
                    ئەگەر هەڵەیەک لەناو هەریەک لە شێعرەکان دا بەدی دەکەن دەتوانن لە ژێر ئەو شێعرە لە بەشی نووسینی بیر و ڕا دا، ڕەخنەکەتان بنووسن تا لە زووترین کات دا پێداچوونەوەی بەسەردا بکرێ.
                </small>
            </h3>
        </a>
    </section></section><section class='pitewsec'>
        <a href="/about">
            <i class='material-icons' style='color:blue;'><img src='/style/img/poets/profile/profile_0.jpg' style='opacity: 0.75;border: 2px dashed #666;border-radius: 100%;width: 0.9em;margin-bottom: 0.1em;'></i>
            <h3>
                ئاڵەکۆک؟
                <br>
                <small>
                    ئەگەر کێشەیەک لە کاری ئاڵەکۆک دا هەیە یان پێشنیارێک‌و بۆ چاکتر بوونی ئاڵەکۆک هەیە، تکایە لێرە کرتە بکەن و لەبەشی "ئاڵەکۆک‌تان بەلاوە چۆنە؟" بۆمان بنووسن.
                </small>
            </h3>
        </a>
    </section>
    <style>
     #QAtxt {
         font-size: 0.65em;
         text-align: right;
         max-width: 90%;
         width: 90%;
         min-height: 8em;
         display: block;
         margin: 1em auto 0;
         height: 155px;
     }
     .btn {
         font-size: 0.65em;
         width: 50%;
         padding: 0.8em 0;
         max-width: 150px;
         cursor: pointer;
         margin-top: 1em;
     }
    </style>
    
    <div style="border-top:1px solid #ddd;margin:1em 0 0.8em;"></div>
    
    <div style="max-width:800px; margin:auto; padding:0 .2em;">
        <h3 style="font-size: .7em;">
            ئەگەر پرسیارێک‌و سەبارەت بە "پتەوکردنی ئاڵەکۆک" هەیە دەتوانن لێرە بیپرسن.
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
            if(@filesize("QA.txt") > 0) {
                
                $f = fopen("QA.txt", "r");
                $cc = fread($f, filesize("QA.txt"));
                $cc = explode("\nend\n", $cc);
                
                echo "<h3 style='border-top: 1px solid #ddd;margin-top: 2em;font-size: .7em;padding: 1em;'>پرسیار و وەڵامەکان</h3>";
                $cc = array_reverse($cc);
                $i = 1;
                foreach($cc as $c) {
                    if(!empty($c)) {
			$c = preg_replace(
			    ["/\[code\]\n*/","/\n*\[\/code\]/"],
			    ["<code>","</code>"], $c);
                        $c = str_replace(["\n"], ["<br>"], $c);
                        echo "<div class='comment'";
                        if($i%2) echo " style='background:#f3f3f3'";
                        echo "><div class='comm-body'>".$c."</div></div>";
                        $i++;
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
