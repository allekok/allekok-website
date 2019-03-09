<?php

include_once("../script/php/constants.php");
include_once("../script/php/colors.php");
include_once("../script/php/functions.php");

$title = _TITLE . "؟";
$desc = $title;
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>

<div id="poets">
    <div>
        <p style="font-size:0.75em;">
            ئاڵەکۆک، هەلێکە بۆ خوێندنەوەی شێعری کوردی.
        </p>
    </div>
    <div class='stats-min'>
        <?php include(ABSPATH . "script/php/stats.php"); ?>
        <i class='sub-num'><?php echo $aths_num; ?></i>
        شاعیر
        &rsaquo;
        <i class='sub-num'><?php echo $hons_num; ?></i>
        شێعر
    </div>
    <div style="font-size:.65em;">
        <span style="color:#666;">
            ئاخیرین نوێ کردنەوەی شێعرەکان: 
        </span>
        <span style="display:inline-block;color:#222;">
            <?php
            $last_update_date = date_create(@file_get_contents(ABSPATH . "last-update.txt"));
	    $now = date_create(date("Y-m-d H:i:s"));
	    echo format_DD(date_diff($now,$last_update_date,true));
            ?>
        </span>
    </div>

    <div style="width:95%;max-width:550px;border-top:1px solid #eee; padding:.5em 0 0; margin:.5em auto;">
        
        <p style="font-size:0.75em;padding-bottom:0.5em;">
            ئاڵەکۆک‌تان بەلاوە چۆنە؟
        </p>

        <div id="message"></div>

        <form id="frmComm" action="/about/append.php" method="POST">

            <textarea placeholder="بیر و ڕاتان سەبارەت بە ئاڵەکۆک بنووسن..." id="commTxt" style="font-size:.65em;max-width:95%;width:95%;min-height:8.5em"></textarea>

            <div class='loader' id="commloader" style="display:none;margin:.5em auto .2em;width:1.5em;height:1.5em;"></div>

            <button type="submit" style="font-size: .65em;width: 50%;max-width: 150px;margin-top:0.5em;" class='button'>ناردن</button>
        </form>

        <?php
        $uri = ABSPATH . "about/res/about.comments";
	$nzuri = file_exists($uri) ?
		 filesize($uri)>0 :
		 false; ?>
        
        <div id="Acomms-title" style="margin:1em 0 .5em;font-size: .8em;<?php if(!$nzuri){echo 'display:none';} ?>">
            بیر و ڕاکان سەبارەت بە ئاڵەکۆک
        </div>

        <div id="Acomms" style="font-size:0.8em;<?php if(!$nzuri){echo('display:none;');} ?>">
            <div class='loader' style="border-top: 3px dashed <?php echo $colors[0][0]; ?>;border-radius:100%;padding:0;animation-duration:0.7s;"></div>
            
            <script>
             var http = new XMLHttpRequest();
	     http.open("get","/about/about-comments.php");
             http.onload = function () {
                 var Acomms = document.getElementById("Acomms");
                 Acomms.innerHTML=this.responseText;
                 Acomms.style.animation="tL-top 0.8s cubic-bezier(.18,.89,.32,1.28)";
             }
             http.send();
            </script>
        </div>
    </div>
</div>

<script>

 function append() {

     var httpd = new XMLHttpRequest(),
	 res = document.getElementById('message'),
	 comm = document.getElementById('commTxt'),
	 loader = document.getElementById('commloader');

     var nullError = "<i style='display:block;background-color:rgba(204,51,0,0.1);color:#444;font-size:0.5em;'>هیچ تان نەنووسیوە.</i>",
	 succMess = "<i style='display:block;background-color:rgba(102,255,204,0.1);color:#444;font-size:0.5em;'>زۆر سپاس بۆ دەربڕینی بیر و ڕاتان سەبارەت بە ئاڵەکۆک.</i>",
	 failMess = "<i style='display:block;background-color:rgba(204,51,0,0.1);color:#444;font-size:0.5em;'>کێشەیەک هەیە. تکایە دووبارە هەوڵ دەنەوە.</i>",
	 // out of range error
	 OoRError = "<i style='display:block;background-color:rgba(204,51,0,0.1);color:#444;font-size:0.5em;'>ژمارەی پیتەکان نابێ لە ۲۶۸۵ پیت زیاتر بێ.</i>",
	 request = "comm="+encodeURIComponent(comm.value);

     if(comm.value === "") {
         comm.focus();
         return 0;
     }

     if(comm.value.length > 2685) {
         res.innerHTML = OoRError;
         comm.style.borderTop = "3px solid rgb(204,51,0)";
         comm.focus();
         setTimeout(function() {
             comm.style.borderTop = "3px solid #ddd";
         }, 3000);
         return 0;
     }

     loader.style.display = "block";
     comm.style.backgroundColor = "#eee";
     comm.style.color = "#999";

     httpd.onload = function() {

         var respond = JSON.parse(this.responseText);

         if(respond.message == "ok") {

             res.innerHTML = succMess;
             comm.style.borderTop = "2px solid #06d";

             var Acomms = document.getElementById('Acomms'),
		 AcommsTitle = document.getElementById('Acomms-title');

             Acomms.style.display = "block";
             AcommsTitle.style.display = "block";
             Acomms.innerHTML = respond.comm + Acomms.innerHTML;
             window.location = "#Acomms-title";
             comm.value="";

         } else {
             res.innerHTML = failMess;
             comm.style.borderTop = "2px solid rgb(204,51,0)";
             setTimeout(function() {
                 comm.style.borderTop = "3px solid #ddd";
             }, 3000);
         }

         loader.style.display = "none";
         comm.style.backgroundColor = "";
         comm.style.color = "";
         
     }

     httpd.open("POST","/about/append.php");
     httpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     httpd.send(request);

 }


 document.getElementById("frmComm").addEventListener("submit", function(e) {
     e.preventDefault();
     append();
 });

</script>


<?php
include_once(ABSPATH . "script/php/footer.php");
?>
