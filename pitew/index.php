<?php
include_once("../script/php/constants.php");
include_once(ABSPATH."script/php/colors.php");
include_once(ABSPATH."script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی شێعر";
$desc = "نووسینی شێعر لەسەر ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH."script/php/header.php");

$_name1 = isset($_GET['name']) ?
	  filter_var($_GET['name'], FILTER_SANITIZE_STRING) : '';
$_poet1 = isset($_GET['poet']) ?
	  filter_var($_GET['poet'], FILTER_SANITIZE_STRING) : '';
$_book1 = isset($_GET['book']) ?
	  filter_var($_GET['book'], FILTER_SANITIZE_STRING) : '';
?>

<div id="poets">
    <div id='adrs'>
	<a href="first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<div id='current-location'>
	    <i class='material-icons'>note_add</i>
	    نووسینی شێعر
	</div>
    </div>
    
    <script>
     function check ()
     {
	 const cntri = document.getElementById("contributorTxt"),
	       poet = document.getElementById("poetTxt"),
	       book = document.getElementById("bookTxt"),
	       txts = document.querySelectorAll("input, textarea"),
	       btns = document.querySelectorAll("button[type=submit]");
	 
         if(poet.value == "")
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

	 getUrl("isitnew.php?poet="+poet.value, function(responseText)
	 {
             const res = JSON.parse(responseText);
             if(res.id != "0")
	     {
                 txts.forEach( function(e)
		 {
                     e.style.borderTopColor = colors[color_num(res.id)][0];
                 });
		 
                 btns.forEach( function(e)
		 {
                     e.style.background = colors[color_num(res.id)][0];
                     e.style.color = colors[color_num(res.id)][1];
                 });
                 
                 poet.style.backgroundImage = `url(/style/img/poets/profile/profile_${res.img}.jpg`;
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
	 font-size:.7em;
	 margin:auto .5em;
     }
    </style>
    
    <div style="max-width:800px;margin:auto">
	<div style='font-size:.53em;text-align:right;padding:0 1em 1em'>
	    دەتوانن بۆ نووسینەوەی شێعر ئەم دیوانانە بەکار بهێنن: 
	    <a class='link'
	       style='border-bottom:1px solid <?php echo $colors[0][0]; ?>;
		      display:inline-block;padding:0' href="/pitew/pdfs.php">
		داگرتنی دیوانی شاعیران
	    </a>
	</div>
        <form id="frmComm" action="append.php" method="POST">
            <div class="input-label-box">
		<input type="text" id="contributorTxt" name="contributor"
		       style="font-size:.7em;width:100%"
		       value="<?php echo $_name1; ?>"
		       placeholder="نێوی خۆتان لێرە بنووسن.">
	    </div>
	    <div class="color-444" id="pitew-stats"
		 style="text-align:right;text-indent:1em;
			padding:.5em 1em 0;font-size:.53em"
	    >ئەو شێعرە بە نێوی خۆتان لەسەر ئاڵەکۆک دادەندرێ.</div>
            <div class="border-eee" style="margin:.8em 0"></div>
	    <div class="input-label-box">
		<label class="color-444" for="poetTxt">شاعیر: </label>
		<input type="text" onblur="check()" id="poetTxt"
		       name="poet" style="font-size:.7em;width:94%"
		       value="<?php echo $_poet1; ?>"
		       placeholder="ناوی شاعیر *">
	    </div>
	    <div class="input-label-box" style="margin-top:1em;">
		<label class="color-444" for="bookTxt">کتێب: </label>
		<input type="text" id="bookTxt" name="book"
		       style="font-size:.7em;width:94%"
		       value="<?php echo $_book1; ?>"
		       placeholder="ناوی کتێب">
	    </div>
	    <div class="input-label-box" style="margin-top:1em">
		<input type="text" id="poemNameTxt" name="poemName"
		       style="font-size:.7em;width:100%"
		       placeholder="سەرناوی شێعر">
	    </div>
	    <div class="input-label-box" style="margin-top:1em">
		<textarea id="poemConTxt" name="poem" style="font-size:.7em;max-width:100%;min-width:100%;min-height:20em;" placeholder="دەقی شێعر *"></textarea>
	    </div>

            <div class='loader' style="display:none"></div>
            
            <div id="message"></div>

            <button type="submit" class="button bth"
		    style="font-size:.7em;width:45%;
			  max-width:150px;margin-top:1em;
			  padding:1em 0"
	    >ناردن</button>
            <button type="button" id="clearBtn" class='button'
		    style="font-size:.7em;width:45%;
			  max-width:150px;margin-top:1em"
	    >پاک کردنەوە</button>
        </form>	
        <?php
	if($_poet1) 
            echo '<script>window.addEventListener("load",check)</script>';
        ?>
    </div>
    <div style="margin-top:2em;font-size:.65em">
        <a id='poems-list' class='link' href="poem-list.php">
            ئەو شێعرانەی کە نووسیوتانە
        </a>
    </div>
</div>

<script>
 window.onload = function()
 {
     const contri = isJson(localStorage.getItem("contributor"));
     if(contri)
     {
	 document.getElementById('contributorTxt').value = contributor.name;
	 document.getElementById('poems-list').href += '?name=' + contributor.name;
	 
	 getUrl(`stats.php?contributor=${contri.name}`, function(responseText)
	 {
             if(responseText != "")
	     {
		 const res = document.getElementById("pitew-stats");
		 res.innerHTML = "جەنابتان تا ئێستا " + responseText + 
				 " شێعرتان لەسەر ئاڵەکۆک نووسیوەتەوە.";	     
		 res.style.animation = "tL 1.2s ease forwards";
             }
	 });
     }     
 }
 
 function pitew ()
 {
     const contributor = document.getElementById("contributorTxt"),
	   poet = document.getElementById("poetTxt"),
	   book = document.getElementById("bookTxt"),
	   poemName = document.getElementById("poemNameTxt"),
	   poem = document.getElementById("poemConTxt"),
	   mess = document.getElementById("message"),
	   loader = document.querySelector(".loader"),
	   http = new XMLHttpRequest(),
	   quest = `contributor=${encodeURIComponent(contributor.value)}&poet=${encodeURIComponent(poet.value)}&book=${encodeURIComponent(book.value)}&poemName=${encodeURIComponent(poemName.value)}&poem=${encodeURIComponent(poem.value)}`;

     if(poet.value == "")
     {
         poet.focus();
         return;
     }
     if(poem.value == "")
     {
         poem.focus();
         return;
     }
     
     loader.style.display = "block";
     
     http.onreadystatechange = function()
     {
         if(this.readyState == 4 && this.status == 200)
	 {
	     const res = JSON.parse(this.responseText);
	     loader.style.display="none";
	     mess.innerHTML = res.message;
	     
	     if(res.state == 1)
	     {
                 poemName.value = poem.value = "";
                 localStorage.setItem("contributor",
				      JSON.stringify(
					  {name : res.contributor.name}
				      ));
	     }
         }
     }
     http.open("post", "append.php");
     http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     http.send(quest);
 }
 
 document.getElementById("frmComm").
	  addEventListener("submit", function(e)
	  {
	      e.preventDefault();
	      pitew();
	  });
 
 const clearBtn = document.getElementById("clearBtn");
 clearBtn.addEventListener("click", function()
 {    
     const poet = document.getElementById("poetTxt"),
	   book = document.getElementById("bookTxt"),
	   poemName = document.getElementById("poemNameTxt"),
	   poem = document.getElementById("poemConTxt"),
	   mess = document.getElementById("message"),
	   txts = document.querySelectorAll("input, textarea"),
	   btns = document.querySelectorAll("button[type=submit]");
     
     mess.innerHTML = poet.value = book.value =
	 poemName.value = poem.value = "";
     
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
