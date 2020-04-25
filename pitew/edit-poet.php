<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo; نووسینی زانیاری سەبارەت بە شاعیران";
$desc = "نووسینی زانیاری سەبارەت بە شاعیران";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");

$_name1 = isset($_GET['name']) ?
	  filter_var($_GET['name'], FILTER_SANITIZE_STRING) : '';
$_poet1 = isset($_GET['poet']) ?
	  filter_var($_GET['poet'], FILTER_SANITIZE_STRING) : '';
?>
<style>
 .input-label-box-edit-poet label {
     font-size:.8em;
     margin:auto .5em;
 }
</style>
<div id="poets">
    <div id='adrs' style="margin-bottom:1em">
	<a href="first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i> &rsaquo; </i>
	<div id="current-location">
	    <i class='material-icons'>person</i>
	    نووسینی زانیاری سەبارەت بە شاعیران
	</div>
    </div>
    
    <div>    
	<script>
	 
	</script>
	
        <form id="frmComm" action="save.php" method="POST">
	    
	    <div class="input-label-box-edit-poet">
		<input type="text" id="contributorTxt" name="contributor"
		       style="font-size:.7em;width:100%"
		       value="<?php echo $_name1; ?>"
		       placeholder="نێوی خۆتان لێرە بنووسن.">
	    </div>

	    <div class="input-label-box-edit-poet" style="margin-top:1em">
		<label for="poetTxt">شاعیر: </label>
		<input type="text" id="poetTxt" name="poet"
		       style="font-size:.7em;width:94%;padding:1em 3%"
		       value="<?php echo $_poet1; ?>" placeholder="نێوی شاعیر *">
	    </div>
	    
            <div class="input-label-box-edit-poet" style="margin-top:1em">
		<textarea id="poetDescTxt" name="poetDesc"
			  style="font-size:.7em;width:100%;height:15em"
			  placeholder="زانیاریەکان سەبارەت بە شاعیر *"></textarea>
	    </div>

            <div class='loader' style="display:none"></div>
            
            <div id="message"></div>

            <button type="submit" class="button bth"
		    style="font-size:.7em;margin-top:1em;
			  padding:.8em 2.5em;border-radius:1em">ناردن</button>
            
            <button type="button" id="clearBtn" class='button'
		    style="font-size:.7em;padding:.8em 2.5em;
			  margin-top:1em">پاک کردنەوە</button>
        </form>        
    </div>
    
    <div style="margin-top:2em;font-size:.65em">
        <a id='desc-list' class='link'
	   href='poetdesc-list.php'
	>ئەو زانیاریانەی کە نووسیوتانە</a>
    </div>    
</div>

<script>
 function check()
 {
     const poet = document.getElementById("poetTxt"),
	   txts = document.querySelectorAll("#poets input, #poets textarea"),
	   btns = document.querySelectorAll("#poets button[type=submit]");
     
     if (poet.value == "")
     {
	 txts.forEach( function(e)
	     {
		 e.style.borderColor = "";
		 e.style.background = "";
	 });
	 btns.forEach( function(e)
	     {
		 e.style.background = "";
		 e.classList.remove("color-white");
	 });
	 return;
     }

     getUrl('isitnew.php?poet='+poet.value, function(responseText)
	 {
             const res = JSON.parse(responseText);
             
             if(res.id != '0')
	     {
		 txts.forEach( function(e)
		     {
			 e.style.borderColor = '<?php echo $_colors[2]; ?>';
		 });
		 btns.forEach( function(e)
		     {
			 e.style.background = '<?php echo $_colors[2]; ?>';
			 e.classList.add("color-white");
		 });
		 poet.style.backgroundImage =
		     `url(<?php echo _R; ?>style/img/poets/profile/profile_${res.img}.jpg`;
		 poet.style.backgroundRepeat = "no-repeat";
		 poet.style.backgroundSize = "auto 100%";
		 poet.style.backgroundPosition = "left center";
             }
	     else
	     {
		 txts.forEach( function(e)
		     {
			 e.style.borderColor = "";
			 e.style.background = "";
		 });
		 btns.forEach( function(e)
		     {
			 e.style.background = "";
			 e.classList.remove("color-white");
		 });
             }
     });
 }
 document.getElementById('poetTxt').onblur = check;
	 <?php
	 if(!$no_head)
	     echo 'window.onload = function() { ';
	 
	 if($_poet1)
	     echo 'check();';
         ?>
 
 const contributor = isJson(localStorage.getItem("contributor"));
 
 if( contributor )
 {
     document.getElementById("contributorTxt").value = contributor.name;
     document.getElementById("desc-list").href += "?name=" + contributor.name;
 }
 
	 <?php
	 if(!$no_head) echo ' } ';
	 ?>
 
 function pitew ()
 {
     const contributor = document.querySelector("#contributorTxt"),
	   poet = document.querySelector("#poetTxt"),
	   poetDesc = document.querySelector("#poetDescTxt"),
	   mess = document.querySelector("#message"),
	   loader = document.querySelector(".loader"),
	   xmlhttp = new XMLHttpRequest();
     
     if(poet.value == "")
     {
         poet.focus();
         return;
     }
     
     if(poetDesc.value == "")
     {
         poetDesc.focus();
         return;
     }
     
     loader.style.display = "block";
     
     const request = `contributor=${encodeURIComponent(contributor.value)}&poet=${poet.value}&poetDesc=${encodeURIComponent(poetDesc.value)}`;
     
     xmlhttp.onload = function ()
     {
         if(this.responseText == "ok")
	 {             
             mess.innerHTML = "<i class='color-blue' style='display:block;\
font-size:.55em;padding:.3em'>زۆر سپاس. بە ئاڵەکۆکەوە زیاد کرا.</i>";
             loader.style.display = "none";
             poet.value = poetDesc.value = "";
             
             localStorage.setItem("contributor",
				  JSON.stringify({name: contributor.value}));
         }
     }
     xmlhttp.open("post", "save.php");
     xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xmlhttp.send(request);
 }
 
 document.getElementById("frmComm").
	  addEventListener("submit", function(e)
	      {
		  e.preventDefault();
		  pitew();
	  });

 const clearBtn = document.getElementById("clearBtn");
 clearBtn.addEventListener("click", function ()
     {    
	 const poet = document.getElementById("poetTxt"),
	       poetDesc = document.getElementById("poetDescTxt"),
	       mess = document.getElementById("message"),
	       txts = document.querySelectorAll("#poets input, #poets textarea"),
	       btns = document.querySelectorAll("#poets button[type=submit]");
	 
	 mess.innerHTML = poet.value = poetDesc.value = "";

	 txts.forEach( function(e)
	     {
		 e.style.borderColor = "";
		 e.style.background = "";
	 });
	 btns.forEach( function(e)
	     {
		 e.style.background = '';
		 e.classList.remove("color-white");
	 });
 });
</script>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
