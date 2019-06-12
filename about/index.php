<?php
include_once("../script/php/constants.php");
include_once(ABSPATH."script/php/colors.php");
include_once(ABSPATH."script/php/functions.php");

$title = _TITLE . "؟";
$desc = $title;
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH."script/php/header.php");
?>
<div id="poets">
    <div>
        <p style="font-size:.75em">
	    ئاڵەکۆک هەلێکە بۆ خوێندنەوەی شێعری کوردی.
        </p>
    </div>
    <div class='stats-min'>
        <?php include(ABSPATH."script/php/stats.php"); ?>
        <i class='sub-num'><?php echo $aths_num; ?></i>
        شاعیر
        &rsaquo;
        <i class='sub-num'><?php echo $hons_num; ?></i>
        شێعر
    </div>
    <div style="font-size:.65em">
        <span class="color-666">
            ئاخیرین نوێ‌کردنەوەی شێعرەکان: 
        </span>
        <span style="display:inline-block">
            <?php
            $last_update_date = date_create(
		@file_get_contents(ABSPATH."last-update.txt"));
	    $now = date_create(date("Y-m-d H:i:s"));
	    echo format_DD(
		date_diff($now,$last_update_date,true));
            ?>
        </span>
    </div>
    <div class="border-eee"
	 style="width:95%;max-width:550px;
		padding:.5em 0 0;margin:.5em auto">
        <p style="font-size:.75em;padding-bottom:.5em">
            ئاڵەکۆک‌تان بەلاوە چۆنە؟
        </p>
        <div id="message"></div>
        <form id="frmComm"
	      action="/about/append.php"
	      method="POST">
            <textarea id="commTxt"
		      style="font-size:.65em;
			  max-width:100%;
			  width:100%;
			  min-height:10em"
		      placeholder="بیر و ڕاتان سەبارەت بە ئاڵەکۆک بنووسن..."
	    ></textarea>
            <div class='loader' id="commloader"
		 style="display:none;
			margin:.5em auto .2em;
			width:1.5em;height:1.5em"
	    ></div>
            <button type="submit"
		    style="font-size:.65em;
			  width:50%;
			  max-width:150px;
			  margin-top:1em"
		    class='button'>ناردن</button>
        </form>
        <?php
        $uri = ABSPATH . "about/comments.txt";
	$nzuri = file_exists($uri) ?
		 filesize($uri)>0 :
		 false;
	?>
        <div id="Acomms-title"
	     style="margin:1em 0 .5em;
		 font-size:.8em;<?php 
				if(!$nzuri)
				    echo 'display:none';
				?>">
            بیر و ڕاکان سەبارەت بە ئاڵەکۆک
        </div>
        <div id="Acomms"
	     style="font-size:.8em;<?php 
				   if(!$nzuri)
				       echo('display:none;'); 
				   ?>">
        </div>
    </div>
</div>
<script>
 window.onload = function () {
     var http = new XMLHttpRequest();
     getUrl(
	 "/about/about-comments.php",
	 function (responseText) {
	     var Acomms = document.
			   getElementById("Acomms");
	     Acomms.innerHTML=responseText;
	     Acomms.style.animation="tL-top 0.8s \
cubic-bezier(.18,.89,.32,1.28)";
	 });
 }
 
 function append() {

     var httpd = new XMLHttpRequest(),
	 res = document.getElementById('message'),
	 comm = document.getElementById('commTxt'),
	 loader = document.getElementById('commloader'),
	 nullError = "<i style='display:block;background:rgba(204,51,0,.1);\
color:#444;font-size:.5em'>هیچ تان نەنووسیوە.</i>",
	 succMess = "<i style='display:block;background:rgba(102,255,204,.1);\
color:#444;font-size:.5em'>زۆر سپاس بۆ دەربڕینی بیر و ڕاتان سەبارەت بە ئاڵەکۆک.</i>",
	 failMess = "<i style='display:block;background:rgba(204,51,0,.1);\
color:#444;font-size:.5em'>کێشەیەک هەیە. تکایە دووبارە هەوڵ دەنەوە.</i>",
	 /* Out of range error */
	 OoRError = "<i style='display:block;background:rgba(204,51,0,.1);\
color:#444;font-size:.5em'>ژمارەی پیتەکان نابێ لە ۲۶۸۵ پیت زیاتر بێ.</i>",
	 request = "comm="+encodeURIComponent(comm.value);

     if(comm.value === "") {
         comm.focus();
         return;
     }
     if(comm.value.length > 2685) {
         res.innerHTML = OoRError;
         comm.style.borderTop = "5px solid rgb(204,51,0)";
         comm.focus();
         setTimeout(function() {
	     comm.style.borderTop = "";
         }, 3000);
         return;
     }     
     loader.style.display = "block";
     comm.style.background = "#eee";
     comm.style.color = "#999";

     httpd.open("POST","/about/append.php");
     httpd.onload = function() {
         var respond = JSON.parse(this.responseText);
         if(respond.message == "ok")
	 {
	     res.innerHTML = succMess;
	     comm.style.borderTop = "5px solid #06d";
	     var Acomms = document.getElementById('Acomms'),
		 AcommsTitle = document.getElementById('Acomms-title');
	     Acomms.style.display = "block";
	     AcommsTitle.style.display = "block";
	     Acomms.innerHTML = respond.comm + Acomms.innerHTML;
	     window.location = "#Acomms-title";
	     comm.value="";
         }
	 else
	 {
	     res.innerHTML = failMess;
	     comm.style.borderTop = "5px solid rgb(204,51,0)";
	     setTimeout(function() {
                 comm.style.borderTop = "";
	     }, 3000);
         }
         loader.style.display = "none";
         comm.style.background = "";
         comm.style.color = "";
     }
     httpd.setRequestHeader(
	 "Content-type",
	 "application/x-www-form-urlencoded");
     httpd.send(request);
 }
 document.getElementById("frmComm").addEventListener("submit", function(e) {
     e.preventDefault();
     append();
 });
</script>
<?php
include_once(ABSPATH."script/php/footer.php");
?>
