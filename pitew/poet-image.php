<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$_name1 = @filter_var($_GET['name'], FILTER_SANITIZE_STRING);
$_poet1 = @filter_var($_GET['poet'], FILTER_SANITIZE_STRING);

/* Check for uploads. */
if( isset($_FILES['profile']) and
	isset($_COOKIE['poet']) )
{
	$_profile = $_FILES["profile"];
	$_poet = filter_var($_COOKIE['poet'], FILTER_SANITIZE_STRING);
	$_name = @filter_var($_COOKIE['name'], FILTER_SANITIZE_STRING);
	$_poet = trim(str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_poet));
	$_name = trim(str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_name));
	$_cnn = $_name ? $_name : "ناشناس";
	$t = time();
	$_profile_dist = "../style/img/poets/new/{$_poet}_{$_cnn}_{$t}.".
			 substr($_profile['type'], 6);
	$_frmts = ["image/jpeg", "image/png"];

	if( !file_exists($_profile_dist) and
		$_profile['size'] <= 5242880 and
		in_array($_profile['type'], $_frmts) )
	{
		if( move_uploaded_file($_profile['tmp_name'], $_profile_dist) )
		{
			$uploaded = "<i class='color-blue' style='font-size:.7em;
padding:.3em;display:block;margin-top:.8em'
>زۆر سپاس بۆ ئێوە. ئەم وێنە بە ئاڵەکۆکەوە زیادکرا.</i><img 
src='$_profile_dist' onclick=\"window.location='$_profile_dist';\" 
id='profilepic' style='width:100%;margin:auto;display:block;min-width:70px;
max-width:200px;cursor:pointer'>";
			list_dir(ABSPATH.'style/img/poets/new');
		}
	}
}

$title = $_TITLE . " &rsaquo; ناردنی وێنەی شاعیران";
$desc = "ناردنی وێنەی شاعیران بۆ ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 .input-label-box-poet-image label {
	 font-size:1em;
	 margin:auto .5em;
 }
</style>
<div id="poets">
	<h1 class="color-blue" style="text-align:right;font-size:1em">
		ناردنی وێنەی شاعیران
	</h1>

	<div style='font-size:.75em'>
		<?php echo @$uploaded; ?>
	</div>
	<!-- file upload sec -->
	<form id="frmUpload" method="POST"
	      enctype="multipart/form-data"
	      style="padding-top:1em;font-size:.7em">
		<div class="input-label-box-poet-image">
			<input type="text" id="cntriTxt" name="cntri"
			       style="font-size:1em;width:100%"
			       value="<?php echo $_name1; ?>"
			       placeholder="نێوی خۆتان لێرە بنووسن.">
		</div>
		<div class="input-label-box-poet-image" style="margin:1em .5em">
			<label for="poetTxt">شاعیر: </label>
			<input type="text" id="poetTxt" name="poet"
			       style="font-size:1em;width:94%;padding:1em 3%"
			       value="<?php echo $_poet1; ?>"
			       placeholder="نێوی شاعیر *">
		</div>
		
		<button class='file-btn button' type="button"
			onclick="document.querySelector('input[name=profile]').click()"
			style="display:inline-block;font-size:1.3em;padding:1em;
			       border-radius:1em;margin:.5em 0"
			id='upldlikebtn'>
			هەڵبژاردنی وێنە
		</button><br>
		<div style="padding-top:.2em;max-width:350px;margin:auto;
			    font-size:.7em;font-family:'kurd',monospace;
			    text-align:right">
			&bull; فۆرمەتی وێنەکەتان دەبێ 
			<span style='padding:0 .2em'>JPG, JPEG, PNG</span>
			بێت.
			<br>
			&bull; گەورەیی وێنەکە نابێ لە 
			<span style='padding:0 .2em'>5MiB</span>
			زیاتر بێت.
		</div>
		<input type="file" style='display:none'
		       name="profile" accept="image/png, image/jpeg">
		<div id="frmUploadMess"></div>
		<button class='button bth' type="submit"
			       style="margin-top:1em;font-size:1em;
			       padding:.8em 2.5em;border-radius:1em"
		>ناردن</button>
	</form>
	
	<div style="margin-top:2em;font-size:.65em">
		<a class='link' href="image-list.php">
			ئەو وێنانەی کە ناردووتانە
		</a>
	</div>
	
	<script>
	 function check ()
	 {
		 const poet = document.getElementById("poetTxt"),
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
					 e.style.background = '';
					 e.classList.remove("color-white");
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
							 e.classList.add("color-white");
					 });
					 poet.style.backgroundImage = `url(<?php echo _R; ?>style/img/poets/profile/profile_${res.img}.jpg`;
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
				 echo 'window.addEventListener("load", function() { ';
			 
			 if($_poet1)
				 echo 'check();';
			 ?>
	 
	 document.querySelector("input[type=file]").
		  addEventListener("change", function ()
			  {
				  const filebtn = document.querySelector(".file-btn");
				  filebtn.innerHTML = "هەڵبژێردرا.";
				  filebtn.style.background = '<?php echo $_colors[2]; ?>';
				  filebtn.classList.add("color-black");
		  });

	 const contri = isJson(localStorage.getItem("contributor"));
	 if(contri)
	 {
		 document.getElementById("cntriTxt").
			  value = contri.name || "";
	 }
	 
	 document.getElementById("frmUpload").addEventListener("submit", function(e)
		 {
			 e.preventDefault();
			 
			 const poetTxt = document.getElementById("poetTxt"),
			       nameTxt = document.getElementById("cntriTxt"),
			       fl = document.querySelector("input[name=profile]"),
			       flbtn = document.querySelector(".file-btn");
			 
			 if(poetTxt.value == "")
			 {
				 poetTxt.focus();
				 return;
			 }
			 if(fl.value == "")
			 {
				 flbtn.style.color = "#fff";
				 flbtn.classList.add("back-red");
				 
				 setTimeout(function()
					 {
						 flbtn.style.color = "";
						 flbtn.classList.remove("back-red");
					 }, 2000);
				 return;
			 }
			 
			 const frmts = ["image/jpeg", "image/png"],
			       frmUploadMess = document.getElementById("frmUploadMess");
			 
			 if(frmts.indexOf(fl.files[0].type) === -1)
			 {
				 frmUploadMess.innerHTML = "<i class='color-red' style='\
font-size:.7em;display:block;padding:.3em'\
>ئەو شتەی هەڵتانبژاردووە وێنە نییە، وێنەیەک هەڵبژێرن.</i>";
				 return;
			 }
			 if(fl.files[0].size > 5242880)
			 {
				 frmUploadMess.innerHTML = "<i class='color-red' style='\
font-size:.7em;display:block;padding:.3em'\
>نابێ گەورەیی وێنەکەتان لە 5MiB زیاتر بێت.</i>";
				 return;
			 }
			 
			 localStorage.setItem("contributor",
					      JSON.stringify({name: nameTxt.value}));
			 
			 document.cookie = "poet="+poetTxt.value;
			 document.cookie = "name="+nameTxt.value;
			 
			 document.getElementById("frmUpload").submit();
			 frmUploadMess.innerHTML="<div class='loader'></div>";
	 });
			 <?php  if(!$no_head) echo ' }); ' ?>
	</script>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
