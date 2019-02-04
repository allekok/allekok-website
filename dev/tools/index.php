<?php

include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; کۆد";
$desc = "ئاڵەکۆک - کۆد";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');
?>

<div id="poets">
    
    <h1 style="font-size:1.2em;"><a style="background: #222;color: #19e31b;display: inline-block;padding: 0.3em 0.8em 0;border-radius: 5px;margin: 1em 0 0.5em;text-decoration:none" href='/dev/tools/'>
        ئاڵەکۆک 
	<sup style="font-size:0.55em; vertical-align:top;">
            єv∂
	</sup></a>
    </h1>
    <style>
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
     h2 {
         text-align:right;
         text-indent:1em;
         font-size:.85em;
         padding-top:1em;
     }
     p {
         text-indent: 2em; padding:1em 0;font-size:0.6em;
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
         margin: auto;
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
    </style>
    <div style="max-width: 800px; margin:auto; padding:1em;line-height:2.3; text-align:justify;">
        <p style="border-bottom:1px solid #ddd"><a href="/dev/" style="color: #00e;">
            بۆ داگرتنی کۆدەکانی ئاڵەکۆک لێرە کرتە بکەن.
        </a></p>
        <p>
            بەخێربێن! لەو بەشە کۆمەڵێک ئامێرمان دابین کردووە کە ئێوەی پڕۆگرامێر(بەرنامەنووس) بتوانن لە دەیتابەیسەکانی ئاڵەکۆک بۆ بەرنامەکەتان کەڵک وەرگرن.
            <br>
            ئاڵەکۆک بە چوار جۆر ئەو زانیاریەنەتان لە ئیختیار دادەنێت:
            <br></p><h2>
		<span style='font-size:1.3em; color:green'>&bull;</span>
		یەکەم، وەرگرتنی زانیاری سەبارەت بە شاعیران
            </h2><p>
		<code style="background:rgba(0,255,0,.05);border-left-color:green">
                https://allekok.com/dev/tools/poet.php?poet=ناوی شاعیر یان ژمارەی شاعیر
		</code>
		ئێوە ئەگەر بچنە ئادرسی سەرەوە و بە جێی "ناوی شاعیر یان ژمارەی شاعیر"، بنووسن هەژار یان تەنیا ژمارەی 1، دەبینن کە تەواوی زانیاریەکانی ئاڵەکۆک سەبارەت بەم شاعیرەتان بۆ دەهێنێت.
		<br><br>
		تکایە سەرنج بدەن:
		<br>
		&bull;
		ئەگەر دەتانهەوێ ناوی شاعیر بنووسن، تکایە ئەو ناوەی کە لە لاپەڕەی یەکەمی ئاڵەکۆک بە ئادرسی "<a style="direction:ltr;text-align:left;color:#00e;" href='https://allekok.com/'>https://allekok.com</a>" بۆ هەر یەک لە شاعیران دابین کراوە، بنووسن.
		<br><br>
		&bull;
		ژمارەی شاعیر ئەم ژمارەیە کە لە ئادرسی لاپەڕەی شاعیردا بەم جۆرە نووسراوە: 
		<code>
            https://allekok.com/poet:ژمارەی شاعیر
		</code>
		<br>
		&bull;
		بۆ وەرگرتنی زانیاری سەبارەت بە چەند شاعیر، ناوی شاعیرەکان یان ژمارەکەیان بەم جۆرە لەیەکتر جودا بکەنەوە:
		بۆ نموونە:
		<code>
            https://allekok.com/dev/tools/poet.php?poet=1,هێمن,3
		</code>
		ئەو نیشانیەی سەرەوە، زانیاریەکانی سەبارەت بە شاعیری ژمارە 1(هەژار)، شاعیری ژمارە 3(وەفایی) و هێمن،تان نیشان دەدا.
		<br>
		&bull; 
		بۆ وەرگرتنی زانیاریەکانی تەواوی شاعیران، بە جێی ناوی شاعیر بنووسن all .
            </p>
            <div class='hr'></div>
            <h2>
		<span style='font-size:1.3em; color:green'>&bull;</span>
		دووهەم، وەرگرتنی زانیاری سەبارەت بە کتێبەکان
            </h2><p>
		<code style="background:rgba(0,255,0,.05);border-left-color:green">
                https://allekok.com/dev/tools/book.php?poet=ناوی شاعیر یان ژمارەی شاعیر&book=ناوی کتێب یان ژمارەی کتێب
		</code>
		ئەگەر بچنە ئادرسی سەرەوە و بە جێی "ناوی شاعیر یان ژمارەی شاعیر" بنووسن هەژار یان تەنیا ڕەقەمی 1 و بە جێی "ناوی کتێب یان ژمارەی کتێب" بنووسن ئاڵەکۆک یان تەنیا ڕەقەمی 3، دەبینن کە تەواوی زانیاریەکانی ئاڵەکۆک سەبارەت بەو کتێبە‌و بۆ دەهێنێت.
		<br><br>
		تکایە سەرنج بدەن:
		<br>
		&bull;
		ژمارەی کتێب ئەم ژمارەیە کە لە ئادرسی لاپەڕەی ئەم کتێبەدا نووسراوە: 
		<code>
            https://allekok.com/poet:ژمارەی شاعیر/book:ژمارەی کتێب
		</code>
		<br>
		بۆ نموونە ئەگەر ئێوە بچنە ناو لاپەڕەی کتێبی ئاڵەکۆکی هەژار موکریانی‌دا، دەبینن کە نیشانی ماڵپەڕەکە بەم جۆرە نووسراوە:
		https://allekok.com/poet:1/book:3
		<br>
		لە ڕوی ئەم نیشانیە دیارە کە ژمارەی کتێبی ئاڵەکۆک، 3یە.
		<br></p>
		<div class='hr'></div>
		<h2>
		    <span style='font-size:1.3em; color:green'>&bull;</span>
		    سێهەم، وەرگرتنی زانیاری سەبارەت بە شێعرەکان
		</h2><p>
		    <code style="background:rgba(0,255,0,.05);border-left-color:green">
                https://allekok.com/dev/tools/poem.php?poet=ناو یان ژمارەی شاعیر&book=ناو یان ژمارەی کتێب&poem=ناو یان ژمارەی شێعر
		    </code>
		    ئەگەر سەردانی نیشانی سەرەوە بکەن و بە جێی "ناو یان ژمارەی شاعیر" بنووسن هەژار یان 1 و بە جێی "ناو یان ژمارەی کتێب" بنووسن ئاڵەکۆک یان 3 و بە جێی "ناو یان ژمارەی شێعر" بنووسن لای لایە یان 1، شێعری لای لایەی هەژارموکریانی‌تان بۆ دەهێنێت.
		    <br><br>
		    سەرنج بدەن:
		    <br>
		    &bull;
		    بۆ دۆزینەوەی ژمارەی شێعر، سەردانی لاپەڕەی ئەو شێعرەی مەبەست‌تانە بکەن و ئەم ژمارەی لەپەنای ناوی شێعر هاتووە، ئەمە ژمارەی شێعرەکەیە. ئەگەر بڕواننە نیشانی ئەم لاپەڕەش دەتوانن ژمارەی شێعر بدۆزنەوە.
		    <code>
            https://allekok.com/poet:ژمارەی شاعیر/book:ژمارەی کتێب/poem:ژمارەی شێعر
		    </code>
		    <br>
		    &bull;
		    ئێوە دەتوانن بە جوێ کردنەوەی ناو یان ژمارەی شێعر بە "," سەبارەت بە هەرچەند شێعر کە بتانهەوێت، زانیاری وەرگرن.
		    <br>
		    بۆ نموونە:
		    <code>
                https://allekok.com/dev/tools/poem.php?poet=1&book=3&poem=لای لایە,2,6
		    </code>
		    <br>
		    &bull;
		    دەقی شێعرەکان بە دوو جۆر دەتوانن وەرگرن یەکەم بە فۆرمەتی سادە(text/plain) دووهەم بە فۆرمەتی (text/html).
		    <br>
		    لە حاڵەتی ئاسایی دا شێعرەکان بە فۆرمەتی سادە نیشان دەدرێن. بەڵام ئەگەر بە شێوەی خوارەوە نیشانیەکەی بگۆڕن، شێعرەکان بە شێوەی html نیشان دەدرێن.
		    <code>
                https://allekok.com/dev/tools/poem.php?poet=1&book=3&poem=1,3&html
		    </code>
		    <br>
		    &bull; 
		    بۆ وەرگرتنی تەواوی شێعرەکانی یەک کتێب بە جێی ژمارەی شێعر بنووسن all .
		</p>
		<div class='hr'></div>
		<h2>
		    <span style='font-size:1.3em; color:green'>&bull;</span>
		    چوارەم، گەڕان لە ئاڵەکۆک‌دا
		</h2><p>
		    <code style="background:rgba(0,255,0,.05);border-left-color:green">
            https://allekok.com/dev/tools/search.php?q=وشە&poet=ناوی شاعیر&pt=ئەژماری شاعیران&bk=ئەژماری کتێبەکان&pm=ئەژماری شێعرەکان&k=چۆنیەتی گەڕان
		    </code>
		    &bull; 
		    q: 
		    ئەو وشەیەی کە دەتانهەوێ بەدووی دا بگەڕێن
		    <br>
		    &bull; 
		    poet: 
		    گەڕان لە شێعرەکانی ئەم شاعیرەدا. سەرنج بدەن کە دەبێ نێوی شاعیر کە لە لاپەڕەی یەکەمی ئاڵەکۆک‌دا هاتووە بنووسن.
		    <br>
		    &bull; 
		    pt: 
		    ئەژماری ئاکامەکان لە گەڕان بەنێو شاعیران‌دا
		    <br>
		    &bull; 
		    bk: 
		    ئەژماری ئاکامەکان لە گەڕان بەنێو کتێبەکان‌دا
		    <br>
		    &bull; 
		    pm: 
		    ئەژماری ئاکامەکان لە گەڕان بەنێوە شێعرەکان‌دا
		    <br>
		    &bull; 
		    k: <br>
		    <span style="padding-right:1em;text-indent:0;display:block;">
			&bull;  
			ئەگەر بنووسن 1، گەڕانەکان تەنیا لە سەرناوی شێعرەکان‌دا دەبێ.
			<br>
			&bull;  
			ئەگەر بنووسن 2، گەڕانەکان تەنیا لە دەقی شێعرەکان‌دا دەبێ.
			<br>
			&bull;  
			ئەگەر بنووسن 3 یان هیچ نەنووسن، گەڕانەکان هەردوو نێوی شێعر و دەقی شێعردا دەبێ.
		    </span>
		    <br>
		    بۆ نموونە: 
		    <code>
             https://allekok.com/dev/tools/search.php?q=ئاشق&poet=هێمن&pt=0&bk=0&pm=30&k=3
		    </code>
		    لینکی سەرەوە بەدوای وشەی "ئاشق" لە شێعرەکانی هێمن دا دەگەڕێت.
		    <br>
		    سەرنج بدەن کە چون ptوbkمان سیفر داناون هەربۆیە هیچ گەڕانێک لە شاعیران و کتێبەکان دا ناکرێ و تەنیا لە شێعرەکان دا بەدوای ئەم وشەیە دەگەڕێت. چون pmمان 30 داناوە، ئەژماری ئاکامەکان، 30دانە دەبێ. چون kمان 3 داناوە بۆ وشەی دیاری کراو لە سەرناو و دەقی شێعرەکان‌دا دەگەڕێ.
		</p>
		<p style="color:#444;font-size:.5em">
		    سەرنجێکی بچووک: تەواوی ئەو زانیاریانە بە فۆرمەتی JSON لە ئیختیارو دادەندرێ.
		</p>
    </div>
    
    <div style="border-top:1px solid #ddd;margin:0.4em 0 0.8em;"></div>
    
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
            <button type="button" class='button' style="display: inline-block;padding: .7em;font-size: .45em;cursor: pointer;margin: 0 auto 5px 10px;background:#19e31b;color:#222;font-weight:bold;font-family:monospace;" onclick="make_code()">Code</button><span style="font-size:.45em">ئەگەر کۆدی تێدایە لە پرسیارەکەتان تکایە "Code" بەکار بێنن.
            </span>
            <textarea id="QAtxt"></textarea>
            <div id="QAres"></div>
            <button type="submit" class='button btn' style="background:#222; color:#19e31b;">ناردن</button>
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
             var loader = "<div class='loader' style='border-top:2px solid #19e31b'></div>";
             
             if(txt.value == "") {
                 txt.focus();
                 return;
             }
             
             t.innerHTML = loader;
             
             var x = new XMLHttpRequest();
             x.onload = function() {
                 if(this.responseText == "1") {
                     t.innerHTML = "<span style='background:rgba(0,255,0,.08); color:green;display:block;padding:1em; font-size:.6em;'>زۆرسپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</span>";
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
