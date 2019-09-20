<?php
include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; کۆد";
$desc = "ئاڵەکۆک - کۆد";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
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
    <div style="text-align:justify">
        <p class='p-dev' style="padding-top:0;text-indent:0">
	    <a class="a-dev" href="https://github.com/allekok/www.allekok.com/"
	       style="display:inline-block;padding:.5em 0 .2em">
		- بۆ داگرتنی کۆدەکانی ئاڵەکۆک لێرە کرتە بکەن.
            </a><br>
	    <a class="a-dev" href="https://github.com/allekok/allekok-poems/"
	       style="display:inline-block;padding:.5em 0 .2em">
		- بۆ داگرتنی شێعرەکانی ئاڵەکۆک لێرە کرتە بکەن.
            </a><br>
	    <a class="a-dev" href="https://github.com/allekok/allekok-downloads/"
	       style="display:inline-block;padding:.5em 0 .2em">
		- بۆ داگرتنی کەرەستەکانی‌تری ئاڵەکۆک لێرە کرتە بکەن.
            </a>
	</p>
        <p class='p-dev'>
	    بەخێربێن! ئەم بەشە تایبەت بەو کەسانەیە کە لەبواری بەرنامەنووسی کامپیوتێردا شارەزایی‌یان هەیە.
	    <br>
	    لێرە کۆمەڵێک ئامێرمان ئامادە کردووە کە ئێوە بتوانن لە دەیتابەیسەکانی ئاڵەکۆک بۆ بەرنامەکان‌تان کەڵک وەرگرن.
        </p><h2 class="color-blue h2-dev">
	    یەکەم، وەرگرتنی زانیاری سەبارەت بە شاعیران
        </h2><p class='p-dev'>
	    <code class='border-blue code-dev'>
                https://allekok.com/dev/tools/poet.php?poet=ناوی شاعیر یان ژمارەی شاعیر
	    </code>
	    ئێوە ئەگەر بچنە ئادرسی سەرەوە و بە جێی "ناوی شاعیر یان ژمارەی شاعیر"، بنووسن هەژار یان تەنیا ژمارەی 1، دەبینن کە تەواوی زانیاریەکانی ئاڵەکۆک سەبارەت بەم شاعیرەتان بۆ دەهێنێت.
	    <br><br>
	    تکایە سەرنج بدەن:
	    <br>
	    &bull;
	    ئەگەر دەتانهەوێ ناوی شاعیر بنووسن، تکایە ئەو ناوەی کە لە لاپەڕەی یەکەمی ئاڵەکۆک بە ئادرسی "<a class="link a-dev" style="direction:ltr;text-align:left" href='https://allekok.com/'>allekok.com</a>" بۆ هەر یەک لە شاعیران دابین کراوە، بنووسن.
	    <br><br>
	    &bull;
	    ژمارەی شاعیر ئەم ژمارەیە کە لە ئادرسی لاپەڕەی شاعیردا بەم جۆرە نووسراوە: 
	    <code class='code-dev'>
            https://allekok.com/poet:ژمارەی شاعیر
	    </code>
	    <br>
	    &bull;
	    بۆ وەرگرتنی زانیاری سەبارەت بە چەند شاعیر، ناوی شاعیرەکان یان ژمارەکەیان بەم جۆرە لەیەکتر جودا بکەنەوە:
	    بۆ نموونە:
	    <code class='code-dev'>
            https://allekok.com/dev/tools/poet.php?poet=1,هێمن,3
	    </code>
	    ئەو نیشانیەی سەرەوە، زانیاریەکانی سەبارەت بە شاعیری ژمارە 1(هەژار)، شاعیری ژمارە 3(وەفایی) و هێمن،تان نیشان دەدا.
	    <br>
	    &bull; 
	    بۆ وەرگرتنی زانیاریەکانی تەواوی شاعیران، بە جێی ناوی شاعیر بنووسن all .
        </p>
        <h2 class='color-blue h2-dev'>
	    دووهەم، وەرگرتنی زانیاری سەبارەت بە کتێبەکان
        </h2><p class='p-dev'>
	    <code class='border-blue code-dev'>
                https://allekok.com/dev/tools/book.php?poet=ناوی شاعیر یان ژمارەی شاعیر&book=ناوی کتێب یان ژمارەی کتێب
	    </code>
	    ئەگەر بچنە ئادرسی سەرەوە و بە جێی "ناوی شاعیر یان ژمارەی شاعیر" بنووسن هەژار یان تەنیا ڕەقەمی 1 و بە جێی "ناوی کتێب یان ژمارەی کتێب" بنووسن ئاڵەکۆک یان تەنیا ڕەقەمی 3، دەبینن کە تەواوی زانیاریەکانی ئاڵەکۆک سەبارەت بەو کتێبە‌و بۆ دەهێنێت.
	    <br><br>
	    تکایە سەرنج بدەن:
	    <br>
	    &bull;
	    ژمارەی کتێب ئەم ژمارەیە کە لە ئادرسی لاپەڕەی ئەم کتێبەدا نووسراوە: 
	    <code class='code-dev'>
            https://allekok.com/poet:ژمارەی شاعیر/book:ژمارەی کتێب
	    </code>
	    <br>
	    بۆ نموونە ئەگەر ئێوە بچنە ناو لاپەڕەی کتێبی ئاڵەکۆکی هەژار موکریانی‌دا، دەبینن کە نیشانی ماڵپەڕەکە بەم جۆرە نووسراوە:
	    https://allekok.com/poet:1/book:3
	    <br>
	    لە ڕوی ئەم نیشانیە دیارە کە ژمارەی کتێبی ئاڵەکۆک، 3یە.
	    <br></p>
	    <h2 class='color-blue h2-dev'>
		سێهەم، وەرگرتنی زانیاری سەبارەت بە شێعرەکان
	    </h2><p class='p-dev'>
		<code class='border-blue code-dev'>
                https://allekok.com/dev/tools/poem.php?poet=ناو یان ژمارەی شاعیر&book=ناو یان ژمارەی کتێب&poem=ناو یان ژمارەی شێعر
		</code>
		ئەگەر سەردانی نیشانی سەرەوە بکەن و بە جێی "ناو یان ژمارەی شاعیر" بنووسن هەژار یان 1 و بە جێی "ناو یان ژمارەی کتێب" بنووسن ئاڵەکۆک یان 3 و بە جێی "ناو یان ژمارەی شێعر" بنووسن لای لایە یان 1، شێعری لای لایەی هەژارموکریانی‌تان بۆ دەهێنێت.
		<br><br>
		سەرنج بدەن:
		<br>
		&bull;
		بۆ دۆزینەوەی ژمارەی شێعر، سەردانی لاپەڕەی ئەو شێعرەی مەبەست‌تانە بکەن و ئەم ژمارەی لەپەنای ناوی شێعر هاتووە، ئەمە ژمارەی شێعرەکەیە. ئەگەر بڕواننە نیشانی ئەم لاپەڕەش دەتوانن ژمارەی شێعر بدۆزنەوە.
		<code class='code-dev'>
            https://allekok.com/poet:ژمارەی شاعیر/book:ژمارەی کتێب/poem:ژمارەی شێعر
		</code>
		<br>
		&bull;
		ئێوە دەتوانن بە جوێ کردنەوەی ناو یان ژمارەی شێعر بە "," سەبارەت بە هەرچەند شێعر کە بتانهەوێت، زانیاری وەرگرن.
		<br>
		بۆ نموونە:
		<code class='code-dev'>
                https://allekok.com/dev/tools/poem.php?poet=1&book=3&poem=لای لایە,2,6
		</code>
		<br>
		&bull;
		دەقی شێعرەکان بە دوو جۆر دەتوانن وەرگرن یەکەم بە فۆرمەتی سادە(text/plain) دووهەم بە فۆرمەتی (text/html).
		<br>
		لە حاڵەتی ئاسایی دا شێعرەکان بە فۆرمەتی سادە نیشان دەدرێن. بەڵام ئەگەر بە شێوەی خوارەوە نیشانیەکەی بگۆڕن، شێعرەکان بە شێوەی html نیشان دەدرێن.
		<code class='code-dev'>
                https://allekok.com/dev/tools/poem.php?poet=1&book=3&poem=1,3&html
		</code>
		<br>
		&bull; 
		بۆ وەرگرتنی تەواوی شێعرەکانی یەک کتێب بە جێی ژمارەی شێعر بنووسن all .
	    </p>
	    <h2 class='color-blue h2-dev'>
		چوارەم، گەڕان لە ئاڵەکۆک‌دا
	    </h2><p class='p-dev'>
		<code class='border-blue code-dev'>
            https://allekok.com/dev/tools/search.php?q=وشە&poet=ناوی شاعیر&pt=ئەژماری شاعیران&bk=ئەژماری کتێبەکان&pm=ئەژماری شێعرەکان&k=چۆنیەتی گەڕان
		</code>
		&bull; 
		<i class="back-eee back-eee-dev">q</i> : 
		ئەو وشەیەی کە دەتانهەوێ بەدووی دا بگەڕێن
		<br>
		&bull; 
		<i class="back-eee back-eee-dev">poet</i> : 
		گەڕان لە شێعرەکانی ئەم شاعیرەدا. سەرنج بدەن کە دەبێ نێوی شاعیر کە لە لاپەڕەی یەکەمی ئاڵەکۆک‌دا هاتووە بنووسن.
		<br>
		&bull; 
		<i class="back-eee back-eee-dev">pt</i> : 
		ئەژماری ئاکامەکان لە گەڕان بەنێو شاعیران‌دا
		<br>
		&bull; 
		<i class="back-eee back-eee-dev">bk</i> : 
		ئەژماری ئاکامەکان لە گەڕان بەنێو کتێبەکان‌دا
		<br>
		&bull; 
		<i class="back-eee back-eee-dev">pm</i> : 
		ئەژماری ئاکامەکان لە گەڕان بەنێوە شێعرەکان‌دا
		<br>
		&bull; 
		<i class="back-eee back-eee-dev">k</i> : <br>
		<span style="padding-right:1em;text-indent:0;display:block;">
		    - 
		    ئەگەر بنووسن 1، گەڕانەکان تەنیا لە سەرناوی شێعرەکان‌دا دەبێ.
		    <br>
		    - 
		    ئەگەر بنووسن 2، گەڕانەکان تەنیا لە دەقی شێعرەکان‌دا دەبێ.
		    <br>
		    - 
		    ئەگەر بنووسن 3 یان هیچ نەنووسن، گەڕانەکان هەردوو نێوی شێعر و دەقی شێعردا دەبێ.
		</span>
		<br>
		بۆ نموونە: 
		<code class='code-dev'>
             https://allekok.com/dev/tools/search.php?q=ئاشق&poet=هێمن&pt=0&bk=0&pm=30&k=3
		</code>
		لینکی سەرەوە بەدوای وشەی "ئاشق" لە شێعرەکانی هێمن دا دەگەڕێت.
		<br>
		سەرنج بدەن کە چون ptوbkمان سیفر داناون هەربۆیە هیچ گەڕانێک لە شاعیران و کتێبەکان دا ناکرێ و تەنیا لە شێعرەکان دا بەدوای ئەم وشەیە دەگەڕێت. چون pmمان 30 داناوە، ئەژماری ئاکامەکان، 30دانە دەبێ. چون kمان 3 داناوە بۆ وشەی دیاری کراو لە سەرناو و دەقی شێعرەکان‌دا دەگەڕێ.
	    </p>
	    <p class='p-dev'>
		سەرنجێکی بچووک: تەواوی ئەو زانیاریانە بە فۆرمەتی JSON لە ئیختیارو دادەندرێ.
	    </p>
    </div>
    
    <script>
     function make_code() {
	 var inp = document.querySelector("#QAtxt"),
	     start = inp.selectionStart,
	     end = inp.selectionEnd,
	     sel = inp.value.substring(start,end);
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

    <h1 class='color-blue'
	style='font-size:1em;text-align:right'>
	پرسیار و وەڵام
    </h1>
    <div style='padding-right:1em;text-align:right'>
        <small style="display:block;font-size:.6em;">
            ئەگەر سەبارەت بەم بابەتە پرسیارێک‌و هەیە لێرە بینووسن.
            <br>
	    بۆ وەرگرتنی وەڵامی پرسیارەکەتان سەردانی ئەم لاپەڕە بکەنەوە.
	</small>
        <form id="frmQA" action="save.php" method="POST" style="">
	    <div style='text-align:center'>
		<button type="button" class='back-blue color-white' style="display:inline-block;padding:.7em;font-size:.45em;cursor:pointer;margin:0 auto 5px 10px;font-weight:bold;font-family:monospace;" onclick="make_code()">Code</button><span style="font-size:.55em">ئەگەر کۆدی تێدایە لە پرسیارەکەتان تکایە "Code" بەکار بێنن.
		</span>
	    </div>
            <textarea id="QAtxt" class="QAtxt-dev"></textarea>
            <div id="QAres"></div>
            <button type="submit" class='button btn btn-dev'>ناردن</button>
        </form>
        
        <div>
            <?php
            if(@filesize("QA.txt") > 0) {
                
                $f = fopen("QA.txt", "r");
                $cc = fread($f, filesize("QA.txt"));
                $cc = explode("\nend\n", $cc);
                
                $cc = array_reverse($cc);
		
                foreach($cc as $c) {
                    if(!empty($c)) {
			$c = preg_replace(
			    ["/\[code\]\n*/","/\n*\[\/code\]/"],
			    ["<code class='code-dev'>","</code>"], $c);
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
             
             var txt = document.querySelector("#QAtxt"),
		 t = document.querySelector("#QAres"),
		 loader = "<div class='loader'></div>";
             
             if(txt.value == "") {
                 txt.focus();
                 return;
             }
             
             t.innerHTML = loader;
             
             const x = new XMLHttpRequest();
             x.onload = function() {
                 if(this.responseText == "1") {
                     t.innerHTML = "<span style='background:rgba(0,255,0,.08);color:green;display:block;padding:1em;font-size:.6em'>زۆرسپاس. تکایە بۆ وەرگرتنی وەڵامەکەتان سەردانی ئەم لاپەڕە بکەنەوە.</span>";
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
