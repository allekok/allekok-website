<?php
include_once("../script/php/constants.php");
include_once(ABSPATH."script/php/colors.php");
include_once(ABSPATH."script/php/functions.php");

$title = $_TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo; نووسینی شیعر";
$desc = "نووسینی شیعر لەسەر ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH."script/php/header.php");

$_name1 = @trim(filter_var($_GET['name'], FILTER_SANITIZE_STRING));
$_poet1 = @trim(filter_var($_GET['poet'], FILTER_SANITIZE_STRING));
$_book1 = @trim(filter_var($_GET['book'], FILTER_SANITIZE_STRING));
?>
<style>
 .input-label-box-index label {
	 font-size:.7em;
	 margin:auto .5em;
 }
</style>
<div id="poets">
	<div id='adrs' style="font-size:.9em">
		<a href="first.php">
			پتەوکردنی ئاڵەکۆک
		</a>
		<i style='font-style:normal;'> &rsaquo; </i>
		<div id='current-location'>
			<i class='material-icons'>note_add</i>
			نووسینی شیعر
		</div>
	</div>
	
	<div>
		<div style='font-size:.52em;text-align:right;padding:.5em 0 1.5em'>
			<i class="color-blue">
				سەرنج بدەن:
			</i>
			ئەو دەقەی کە بۆمان دەنێرن بەرانبەر بە
			<a class='link-underline'
			   style='display:inline-block;padding:0'
			   href="<?php echo _R; ?>dev/tools/license.php">
				ئەم مافنامەیە
			</a>
			لە سەر ئاڵەکۆک بڵاو دەکرێتەوە.
		</div>
		<form id="frmComm" action="append.php" method="POST">
			<div class="input-label-box-index">
				<input type="text" id="contributorTxt" name="contributor"
				       style="font-size:.7em;width:100%"
				       value="<?php echo $_name1; ?>"
				       placeholder="نێوی خۆتان لێرە بنووسن.">
			</div>
			<div class="input-label-box-index" style="margin-top:.5em">
				<label for="poetTxt">شاعیر: </label>
				<input type="text" id="poetTxt"
				       name="poet" style="font-size:.7em;width:94%"
				       value="<?php echo $_poet1; ?>"
				       placeholder="ناوی شاعیر *">
			</div>
			<div class="input-label-box-index" style="margin-top:.5em;">
				<label for="bookTxt">کتێب: </label>
				<input type="text" id="bookTxt" name="book"
				       style="font-size:.7em;width:94%"
				       value="<?php echo $_book1; ?>"
				       placeholder="ناوی کتێب">
			</div>
			<div class="input-label-box-index" style="margin-top:.5em">
				<input type="text" id="poemNameTxt" name="poemName"
				       style="font-size:.7em;width:100%"
				       placeholder="سەرناوی شیعر">
			</div>
			<div class="input-label-box-index" style="margin-top:.5em">
				<textarea id="poemConTxt" name="poem" style="font-size:.7em;max-width:100%;min-width:100%;height:20em" placeholder="دەقی شیعر *"></textarea>
			</div>

			<div class='loader' style="display:none"></div>
			
			<div id="message"></div>

			<button type="submit" class="button bth"
				      style="font-size:.7em;border-radius:1em;
				      margin-top:1em;padding:.8em 2.5em"
			>ناردن</button>
			<button type="button" id="clearBtn" class='button'
				      style="font-size:.7em;margin-top:1em;
				      padding:.8em 2.5em"
			>پاک کردنەوە</button>
		</form>	
	</div>
	<div style="margin-top:2em;font-size:.65em">
		<a id='poems-list' class='link' href="poem-list.php">
			ئەو شیعرانەی کە نووسیوتانە
		</a>
	</div>
</div>

<script> 
 function pitew ()
 {
	 const contributor = document.getElementById('contributorTxt'),
	       poet = document.getElementById('poetTxt'),
	       book = document.getElementById('bookTxt'),
	       poemName = document.getElementById('poemNameTxt'),
	       poem = document.getElementById('poemConTxt'),
	       mess = document.getElementById('message'),
	       loader = document.querySelector('.loader'),
	       quest = `contributor=${encodeURIComponent(contributor.value)}&poet=${encodeURIComponent(poet.value)}&book=${encodeURIComponent(book.value)}&poemName=${encodeURIComponent(poemName.value)}&poem=${encodeURIComponent(poem.value)}`;

	 if(poet.value == '')
	 {
		 poet.focus();
		 return;
	 }
	 if(poem.value == '')
	 {
		 poem.focus();
		 return;
	 }
	 
	 loader.style.display = 'block';
	 
	 postUrl('append.php', quest, function(response)
		 {
			 const res = JSON.parse(response);
			 loader.style.display = 'none';
			 if(res)
			 {
				 mess.innerHTML = res.message;
				 
				 if(res.state == 1)
				 {
					 poemName.value = poem.value = '';
					 localStorage.setItem('contributor',
							      JSON.stringify(
								      {name : res.contributor.name}
					 ));
				 }
			 }
	 });
 }
 
 document.getElementById('frmComm').
	  addEventListener('submit', function(e)
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
		       txts = document.querySelectorAll("#poets input, #poets textarea"),
		       btns = document.querySelectorAll("#poets button[type=submit]"),
		       loader = document.querySelector('.loader');
		 
		 mess.innerHTML = poet.value = book.value =
			 poemName.value = poem.value = "";
		 
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
		 loader.style.display = 'none';
 });
 function check ()
 {
	 const cntri = document.getElementById("contributorTxt"),
	       poet = document.getElementById("poetTxt"),
	       book = document.getElementById("bookTxt"),
	       txts = document.querySelectorAll("#poets input, #poets textarea"),
	       btns = document.querySelectorAll("#poets button[type=submit]");
	 
	 if(poet.value == "")
	 {
		 txts.forEach( function(e)
			 {
				 e.style.borderColor = "";
				 e.style.background = "";
		 });
		 btns.forEach( function(e)
			 {
				 e.style.background = "";
				 e.classList.add("color-black");
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
						 e.style.borderColor = '<?php echo $_colors[2]; ?>';
				 });
				 
				 btns.forEach( function(e)
					 {
						 e.style.background = '<?php echo $_colors[2]; ?>';
						 e.classList.add("color-black");
				 });
				 
				 poet.style.backgroundImage = `url(<?php echo _R; ?>style/img/poets/profile/profile_${res.img}.jpg)`;
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
						 e.classList.remove("color-black");
				 });
			 }
	 });
 }
 document.getElementById('poetTxt').onblur = check;
 <?php
 if(!$no_head) echo 'window.onload = function() { ';
 if($_poet1) echo 'check();';
 ?>
 const contri = isJson(localStorage.getItem('contributor'));
 if(contri && contri.name) {
	 document.getElementById('contributorTxt').value = contri.name;
	 document.getElementById('poems-list').href += '?name=' + contri.name;
 }
 <?php if(!$no_head) echo ' } '; ?>
</script>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
