<?php

if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی شێعر";
$desc = "نووسینی شێعر لەسەر ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
	
	if(! empty($_GET['name']) ) $_name1 = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
	if(! empty($_GET['poet']) ) $_poet1 = filter_var($_GET['poet'], FILTER_SANITIZE_STRING);
	if(! empty($_GET['book']) ) $_book1 = filter_var($_GET['book'], FILTER_SANITIZE_STRING);
?>

<div id="poets">
<div id='adrs'>
<a href="first.php">
    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
</a>
<i style='font-style:normal;'> &rsaquo; </i>
<div id='current-location'>
    <i style='vertical-align:middle;' class='material-icons'>note_add</i>
    نووسینی شێعر
</div>

<div style='font-size:.65em;'>
    دەتوانن بۆ نووسینەوەی شێعر ئەم دیوانانە بەکار بهێنن: 
    <a style='color:#00e;display:inline-block;' href="/pitew/pdfs.php">
    داگرتنی دیوانی شاعیران
    </a>
</div>

</div>

    <div style="color:#444; font-size:0.6em;opacity:0;" id="pitew-stats">stats</div>

<script>
    if(localStorage.getItem("contributor") !== null) {
        var contri = JSON.parse(localStorage.getItem("contributor"));
        var res = document.getElementById("pitew-stats");
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            if(this.responseText !== "") {
                res.innerHTML = "جەنابتان تا ئێستا " +
                this.responseText + 
                "شێعرتان لەسەر ئاڵەکۆک نووسیوە.";
                
                res.style.animation = "tL 1.2s ease forwards";
            }
        }
        
        xmlhttp.open("get", `stats.php?contributor=${contri.name}`, true);
        xmlhttp.send();
    }
    function check() {
        var cntr = document.querySelector("#contributorTxt");
        var poet = document.querySelector("#poetTxt");
        var txts = document.querySelectorAll("input, textarea");
        var btns = document.querySelectorAll("button[type=submit]");
        
        if(poet.value == "") {
            txts.forEach(function(e) {
                e.style.borderTopColor = "";
                e.style.background = "";
            });
            btns.forEach(function(e) {
                e.style.background = "#777";
                e.style.color = "#fff";
            });
            document.querySelector('#frmUpload').style.display = "none";
            return;
        }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                var res = JSON.parse(this.responseText);
                if(res.new === 1) {
                    
                    document.querySelector('#frmUpload').style.animation = "tL .5s forwards";
                    document.querySelector('#frmUpload').style.display = "block";
                    document.querySelector('#poetDescTxt').focus();
                    
                    document.querySelector("#dsds").outerHTML = `<a id='dsds' href='poet-image.php?name=${document.querySelector('#contributorTxt').value}&poet=${document.querySelector('#poetTxt').value}' target='_blank' class='button' style='display:inline-block;cursor:pointer;font-size: 0.7em;padding:1em;'>
                    هەڵبژاردنی وێنە
                    </a>`;
                } else {
                    if(document.querySelector('#frmUpload').style.display == "block") {
                        document.querySelector('#frmUpload').style.display = "none";
                        document.querySelector('#bookTxt').focus();
                    }
                }
                
                if(res.id != "0") {
                    txts.forEach(function(e) {
                        e.style.borderTopColor = colors[color_num(res.id)][0];
                    });
                    btns.forEach(function(e) {
                        e.style.background = colors[color_num(res.id)][0];
                        e.style.color = colors[color_num(res.id)][1];
                    });
                    
                    poet.style.backgroundColor = colors[color_num(res.id)][2];
                    poet.style.backgroundImage = `url(/style/img/poets/profile/profile_${res.img}.jpg`;
                    poet.style.backgroundRepeat = "no-repeat";
                    poet.style.backgroundSize = "auto 100%";
                    poet.style.backgroundPosition = "left center";
                } else {
                    txts.forEach(function(e) {
                        e.style.borderTopColor = "";
                        e.style.background = "";
                    });
                    btns.forEach(function(e) {
                        e.style.background = "#777";
                        e.style.color = "#fff";
                    });
                }
            }
            xmlhttp.open("get", "isitnew.php?name="+cntr.value+"&poet="+poet.value, true);
            xmlhttp.send();
    }
</script>
    
    <div style="max-width: 800px;margin: auto;">

        <form id="frmComm" action="append.php" method="POST">
            
            <input type="text" onblur="check()" id="contributorTxt" name="contributor" style="font-size:0.7em;max-width:94%;min-width:94%;" value="<?php echo $_name1; ?>" placeholder="نێوی خۆتان لێرە بنووسن.">
            <p style="text-align: right;text-indent: 1em;padding: .5em 1em 0;font-size: .5em;color: #444;">
                ئەو شێعرە بە نێوی خۆتان لەسەر ئاڵەکۆک دادەندرێ.
            </p>
            
            <div style="border-top:1px solid #ddd;margin:.8em 0;"></div>
            
            <input type="text" onblur="check()" id="poetTxt" name="poet" style="font-size:0.7em;max-width:94%;min-width:94%;" value="<?php echo $_poet1; ?>" placeholder="ناوی شاعیر *">
            
            
            <!-- file upload sec -->
            <div id="frmUpload" style="max-width:800px;margin:auto;display:none;">
                <textarea id="poetDescTxt" name="poetDesc" style="font-size:0.6em;max-width:94%;min-width:94%;margin-top:1em;min-height:9em" placeholder="سەبارەت بە شاعیر (وەکوو: ناسناوی ئەدەبی، شوێن و ڕێکەوتی لەدایکبوون یان هەر زانیاریەکی تر کە پێتان خۆشە لەسەر ئاڵەکۆک دابندرێ.)"></textarea>
                
                    <div style="padding:1.2em 0.3em 0.1em; text-align:right; text-indent:1em;font-size:0.5em;color:#222;">
                        ئەگەر دەتانهەوێ وێنەی شاعیر لەسەر ئاڵەکۆک دابندرێ، لەسەر "هەڵبژاردنی وێنە" کرتە بکەن.
                    </div>
                    
                <a href='poet-image.php?name=' target="_blank" id="dsds" class='button' style="display:inline-block;cursor:pointer;font-size: 0.7em;padding:1em;">
                    هەڵبژاردنی وێنە
                    </a>
            </div>
            
            <input type="text" id="bookTxt" name="book" style="font-size:0.7em;max-width:94%;min-width:94%;margin-top:1em;" value="<?php echo $_book1; ?>" placeholder="ناوی کتێب">
            
            <input type="text" id="poemNameTxt" name="poemName" style="font-size:0.7em;max-width:94%;min-width:94%;margin-top:1em;" placeholder="سەرناوی شێعر">

            <textarea id="poemConTxt" name="poem" style="font-size:0.7em;max-width:94%;min-width:94%;min-height:20em;margin-top:1em;" placeholder="دەقی شێعر *"></textarea>

            <div class='loader' id="commloader" style="display:none;"></div>
            
            <div id="message"></div>

            <button type="submit" class="button bth" style="font-size: 0.7em;width: 45%;max-width: 150px;margin-top:0.5em;background:#777;color:#fff;">ناردن</button>
            
            <button type="button" id="clearBtn" class='button' style="font-size: 0.7em;width: 45%;max-width: 150px;margin-top:0.5em;">پاک کردنەوە</button>
        </form>
        <?php if(isset($_poet1)) { ?>
        <script>check()</script>
        <?php } ?>
        
    </div>
    <div style="margin-top:2em;">
        <a id='poems-list' class='button' href="poem-list.php">
             ئەو شێعرانەی کە نووسیوتانە
        </a>
    </div>
    
</div>

<script>
    
    window.onload = function() {
        var contributor = localStorage.getItem("contributor");
        
        if( contributor != null) {
            contributor = JSON.parse(contributor);
            
            document.querySelector("#contributorTxt").value = contributor.name;
            document.querySelector('#poems-list').href += "?name=" + contributor.name;
        }
        
    }
    
    function pitew() {
        
        var contributor = document.querySelector("#contributorTxt");
        var poet = document.querySelector("#poetTxt");
        var poetDesc = document.querySelector("#poetDescTxt");
        var book = document.querySelector("#bookTxt");
        var poemName = document.querySelector("#poemNameTxt");
        var poem = document.querySelector("#poemConTxt");
        
        var loader = document.querySelector("#commloader");
        
        var mess = document.querySelector("#message");
        
        if(poet.value == "") {
            poet.focus();
            return;
        }
        if(poem.value == "") {
            poem.focus();
            return;
        }
        
        loader.style.display="block";
        
        var quest = `contributor=${contributor.value}&poet=${poet.value}&book=${book.value}&poemName=${poemName.value}&poem=${encodeURIComponent(poem.value)}&poetDesc=${encodeURIComponent(poetDesc.value)}`;
        
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                
                var res = JSON.parse(xmlhttp.responseText);
                
                loader.style.display="none";
                
                mess.innerHTML = res.message;
                
                if(res.state == 1) {
                    poemName.value = poem.value = poetDesc = "";
                    document.querySelector("#frmUpload").style.display = "none";

                    var contrib = {
                        name : res.contributor.name,
                        ID : res.contributor.ID
                    };
                    
                    localStorage.setItem("contributor", JSON.stringify(contrib));
                } 
            }
        }
        
        xmlhttp.open("post", "append.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(quest);
        
        
    }
    
    var frmPitew = document.querySelector("#frmComm");
    
    if( frmPitew !== null ) {
        frmPitew.addEventListener("submit", function(e) {
            e.preventDefault();
            pitew();
            });
    }
    
    var clearBtn = document.querySelector("#clearBtn");
    
    clearBtn.addEventListener("click", function() {
        
        var poet = document.querySelector("#poetTxt");
        var book = document.querySelector("#bookTxt");
        var poemName = document.querySelector("#poemNameTxt");
        var poem = document.querySelector("#poemConTxt");
        var poetDesc = document.querySelector("#poetDescTxt");
        
        var mess = document.querySelector("#message");
        
        mess.innerHTML = poet.value = book.value = poemName.value = poem.value = poetDesc.value = "";
        var txts = document.querySelectorAll("input, textarea");
        var btns = document.querySelectorAll("button[type=submit]");
        txts.forEach(function(e) {
            e.style.borderTopColor = "";
            e.style.background = "";
        });
        btns.forEach(function(e) {
            e.style.background = "#777";
            e.style.color = "#fff";
        });
        
        document.querySelector("#frmUpload").style.display = "none";
    });
</script>

<?php
	require_once("../script/php/footer.php");
?>