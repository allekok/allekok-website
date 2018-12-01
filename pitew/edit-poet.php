<?php

if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی زانیاری سەبارەت بە شاعیران";
$desc = "نووسینی زانیاری سەبارەت بە شاعیران";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
	
	if(! empty($_GET['name']) ) $_name1 = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
	if(! empty($_GET['poet']) ) $_poet1 = filter_var($_GET['poet'], FILTER_SANITIZE_STRING);
?>

<div id="poets">
<div id='adrs'>
<a href="first.php">
    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
</a>
<i style='font-style:normal;'> &rsaquo; </i>
<div id="current-location" style="color: rgb(154, 205, 50);">
<i style='vertical-align:middle;' class='material-icons'>person</i>
نووسینی زانیاری سەبارەت بە شاعیران
</div>

</div>
    
    <div style="max-width: 800px;margin: auto;">
        
    <script>
    function check() {
        var poet = document.querySelector("#poetTxt");
        if(poet.value == "") {
            poet.style.borderTopColor = "rgb(154, 205, 50)";
            poet.style.background = "";
            return;
        }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                var res = JSON.parse(this.responseText);
                
                if(res.id != "0") {
                    poet.style.borderTopColor = colors[res.id][0];
                    poet.style.backgroundColor = colors[res.id][2];
                    poet.style.backgroundImage = `url(/style/img/poets/profile/profile_${res.img}.jpg`;
                    poet.style.backgroundRepeat = "no-repeat";
                    poet.style.backgroundSize = "auto 100%";
                    poet.style.backgroundPosition = "left center";
                } else {
                    poet.style.borderTopColor = "rgb(154, 205, 50)";
                    poet.style.background = "";
                }
            }
            xmlhttp.open("get", "isitnew.php?poet="+poet.value, true);
            xmlhttp.send();
    }
    </script>

        <form id="frmComm" action="save.php" method="POST">
            
            <input type="text" id="contributorTxt" name="contributor" style="font-size:0.7em;max-width:94%;min-width:94%;border-top:3px solid rgb(154, 205, 50);" value="<?php echo $_name1; ?>" placeholder="نێوی خۆتان لێرە بنووسن.">
            

            <input onblur="check()" type="text" id="poetTxt" name="poet" style="font-size:0.7em;max-width:94%;min-width:94%;border-top:3px solid rgb(154, 205, 50);margin-top:1em" value="<?php echo $_poet1; ?>" placeholder="نێوی شاعیر *">
            <?php if(isset($_poet1)) { ?> <script>check()</script> <?php } ?>
           
            <textarea id="poetDescTxt" name="poetDesc" style="font-size:0.7em;max-width:94%;min-width:94%;min-height:15em;border-top:3px solid rgb(154, 205, 50);margin-top:1em" placeholder="زانیاریەکان سەبارەت بە شاعیر *"></textarea>

            <div class='loader' id="commloader" style="display:none;border-top:1px solid rgb(154, 205, 50)"></div>
            
            <div id="message"></div>

            <button type="submit" class="button bth" style="font-size: 0.7em;width: 45%;max-width: 150px;background-color: rgb(154, 205, 50);color: #fff;margin-top:0.5em;">ناردن</button>
            
            <button type="button" id="clearBtn" class='button' style="font-size: 0.7em;width: 45%;max-width: 150px;margin-top:0.5em;">پاک کردنەوە</button>
        </form>
        
    </div>
    
    <div style="margin-top:2em;">
        <a id='desc-list' class='button' href="poetdesc-list.php">
             ئەو زانیاریانەی کە نووسیوتانە
        </a>
    </div>
    
</div>

<script>
    
    window.onload = function() {
        var contributor = localStorage.getItem("contributor");
        
        if( contributor != null) {
            contributor = JSON.parse(contributor);
            
            document.querySelector("#contributorTxt").value = contributor.name;
            document.querySelector('#desc-list').href += "?name=" + contributor.name;
        }
    }
    
    function pitew() {
        var contributor = document.querySelector("#contributorTxt");
        var poet = document.querySelector("#poetTxt");
        var poetDesc = document.querySelector("#poetDescTxt");
        
        var mess = document.querySelector("#message");
        var loader = document.querySelector(".loader");
        
        if(poet.value === "") {
            poet.style.borderColor = "rgb(204,51,0)";
            poet.style.background = "rgba(204,51,0,0.1)";
            poet.focus();
            
            setTimeout(function() {
                poet.style.borderColor = "rgb(154, 205, 50)";
                poet.style.background = "";
            }, 2000);
            
            return;
        }
        
        if(poetDesc.value === "") {
            poetDesc.style.borderColor = "rgb(204,51,0)";
            poetDesc.style.background = "rgba(204,51,0,0.1)";
            poetDesc.focus();
            
            setTimeout(function() {
                poetDesc.style.borderColor = "rgb(154, 205, 50)";
                poetDesc.style.background = "";
            }, 2000);
            
            return;
        }
        
        loader.style.display = "block";
        
        var request = `contributor=${contributor.value}&poet=${poet.value}&poetDesc=${encodeURIComponent(poetDesc.value)}`;
        
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onload = function() {
            
            if(this.responseText === "ok") {
                
                mess.innerHTML = "<i style='display:block;background:rgba(0,200,0,0.1); color:#555;font-size:0.55em;padding:.3em'>زۆر سپاس. دوای پێداچوونەوە لەسەر ئاڵەکۆک دادەندرێ.</i>";
                loader.style.display = "none";
                poet.value = poetDesc.value = "";
                
                //localStorage
                var email = "";
                if(localStorage.getItem("contributor") !== null) {
                    var email = JSON.parse(localStorage.getItem("contributor")).ID || "";
                }
                localStorage.setItem("contributor", JSON.stringify({name: contributor.value, ID: email}));
                ///
            }
            
        }
        xmlhttp.open("post", "save.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(request);
    }
    
    var frmPitew = document.querySelector("#frmComm");
    
        frmPitew.addEventListener("submit", function(e) {
            e.preventDefault();
            pitew();
        });
    
    var clearBtn = document.querySelector("#clearBtn");
    
    clearBtn.addEventListener("click", function() {
        
        var poet = document.querySelector("#poetTxt");
        var poetDesc = document.querySelector("#poetDescTxt");
        
        var mess = document.querySelector("#message");
        
        mess.innerHTML = poet.value = poetDesc.value = "";
        poet.style.background = "";
        poet.style.borderTopColor = "rgb(154, 205, 50)";
    });
</script>

<?php
	require_once("../script/php/footer.php");
?>