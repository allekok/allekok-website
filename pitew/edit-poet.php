<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی زانیاری سەبارەت بە شاعیران";
$desc = "نووسینی زانیاری سەبارەت بە شاعیران";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");

$_name1 = isset($_GET['name']) ?
	  filter_var($_GET['name'], FILTER_SANITIZE_STRING) : '';
$_poet1 = isset($_GET['poet']) ?
	  filter_var($_GET['poet'], FILTER_SANITIZE_STRING) : '';
?>
<div id="poets">
    <div id='adrs'>
	<a href="first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i> &rsaquo; </i>
	<div id="current-location">
	    <i class='material-icons'>person</i>
	    نووسینی زانیاری سەبارەت بە شاعیران
	</div>
    </div>
    
    <div style="max-width:800px;margin:auto">    
	<script>
	 function check()
	 {
             const poet = document.getElementById("poetTxt"),
		   txts = document.querySelectorAll("input, textarea"),
		   btns = document.querySelectorAll("button[type=submit]");
	     
             if (poet.value == "")
	     {
		 txts.forEach( function(e)
		 {
                     e.style.borderTopColor = "";
                     e.style.background = "";
		 });
		 btns.forEach( function(e)
		 {
                     e.style.background = "";
                     e.style.color = "";
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
                         e.style.borderTopColor = colors[0][0];
                     });
                     btns.forEach( function(e)
		     {
                         e.style.background = colors[0][0];
                         e.style.color = colors[0][1];
                     });
                     poet.style.backgroundImage =
			 `url(/style/img/poets/profile/profile_${res.img}.jpg`;
                     poet.style.backgroundRepeat = "no-repeat";
                     poet.style.backgroundSize = "auto 100%";
                     poet.style.backgroundPosition = "left center";
                 }
		 else
		 {
                     txts.forEach( function(e)
		     {
                         e.style.borderTopColor = "";
                         e.style.background = "";
                     });
                     btns.forEach( function(e)
		     {
                         e.style.background = "";
                         e.style.color = "";
                     });
                 }
             });
	 }
	</script>
	
	<style>
	 .input-label-box {
	     display:flex;
	     margin:0 .5em;
	 }
	 .input-label-box label {
	     font-size:.8em;
	     margin:auto .5em;
	 }
	</style>

        <form id="frmComm" action="save.php" method="POST">
	    
	    <div class="input-label-box">
		<input type="text" id="contributorTxt" name="contributor"
		       style="font-size:.7em;width:100%"
		       value="<?php echo $_name1; ?>"
		       placeholder="نێوی خۆتان لێرە بنووسن.">
	    </div>

	    <div class="input-label-box" style="margin-top:1em">
		<label class="color-444" for="poetTxt">شاعیر: </label>
		<input onblur="check()" type="text" id="poetTxt" name="poet"
		       style="font-size:.7em;width:94%;padding:1em 3%"
		       value="<?php echo $_poet1; ?>" placeholder="نێوی شاعیر *">
	    </div>
	    
            <div class="input-label-box" style="margin-top:1em">
		<textarea id="poetDescTxt" name="poetDesc"
			  style="font-size:.7em;width:100%;min-height:15em"
			  placeholder="زانیاریەکان سەبارەت بە شاعیر *"></textarea>
	    </div>

            <div class='loader' style="display:none"></div>
            
            <div id="message"></div>

            <button type="submit" class="button bth"
		    style="font-size:.7em;width:45%;
			  max-width:150px;margin-top:1em;
			  padding:1em 0">ناردن</button>
            
            <button type="button" id="clearBtn" class='button'
		    style="font-size:.7em;width:45%;max-width:150px;
			  margin-top:1em">پاک کردنەوە</button>
        </form>
        
        <?php if($_poet1) { ?>
            <script>window.addEventListener("load",check)</script>
	<?php } ?>
        
    </div>
    
    <div style="margin-top:2em;font-size:.65em">
        <a id='desc-list' class='link'
	   href='poetdesc-list.php'
	>ئەو زانیاریانەی کە نووسیوتانە</a>
    </div>
    
</div>

<script>
 window.onload = function()
 {
     const contributor = isJson(localStorage.getItem("contributor"));
     
     if( contributor )
     {
         document.getElementById("contributorTxt").value = contributor.name;
         document.getElementById("desc-list").href += "?name=" + contributor.name;
     }
 }
 
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
             mess.innerHTML = "<i style='display:block;background:rgba(0,200,0,0.1);\
color:#555;font-size:.55em;padding:.3em'>زۆر سپاس. دوای پێداچوونەوە لەسەر ئاڵەکۆک دادەندرێ.</i>";
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
		    txts = document.querySelectorAll("input, textarea"),
		    btns = document.querySelectorAll("button[type=submit]");
	      
	      mess.innerHTML = poet.value = poetDesc.value = "";

	      txts.forEach( function(e)
	      {
		  e.style.borderTopColor = "";
		  e.style.background = "";
	      });
	      btns.forEach( function(e)
	      {
		  e.style.background = "";
		  e.style.color = "";
	      });
	  });
</script>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
