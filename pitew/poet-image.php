<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

// check for uploads
$_name1 = filter_var(@$_GET['name'], FILTER_SANITIZE_STRING);
$_poet1 = filter_var(@$_GET['poet'], FILTER_SANITIZE_STRING);

if(isset($_FILES['profile']) && isset($_COOKIE['poet'])) {
    
    $_profile = $_FILES["profile"];
    $_poet = filter_var($_COOKIE['poet'], FILTER_SANITIZE_STRING);
    $_name = filter_var($_COOKIE['name'], FILTER_SANITIZE_STRING);
    $_poet = str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_poet);
    $_name = str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_name);
    $t = time();
    
    $_cnn = $_name ? $_name : $_SERVER['REMOTE_ADDR'];
    
    $_profile_dist = "../style/img/poets/new/{$_poet}_{$_cnn}_{$t}.".substr($_profile['type'], 6);
    
    $_frmts = array("image/jpeg", "image/png");
    

    if(! ( file_exists($_profile_dist) ) && $_profile['size']<=5242880 && in_array($_profile['type'], $_frmts)) {
        
        if( move_uploaded_file($_profile['tmp_name'], $_profile_dist) ) {
            
            $uploaded = "<i style='font-size:0.7em;color:#444;background:rgba(0,250,0,0.1);padding:.3em;display: block;margin-top: .8em;'>زۆر سپاس بۆ ئێوە. ئەو وێنە دوای پێداچوونەوە لەسەر ئاڵەکۆک دادەندرێ.</i><img src='{$_profile_dist}' onclick=\"window.location='{$_profile_dist}';\" id='profilepic' style='width:100%;margin:auto;display:block;min-width:70px;max-width:200px;cursor:pointer;'>";
        }
    }
}
// //////////

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; ناردنی وێنەی شاعیران";
$desc = "ناردنی وێنەی شاعیران بۆ ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');

?>

<div id="poets">
    
    <div id='adrs'>
	<a href="first.php">
	    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<div id="current-location">
	    <i style='vertical-align:middle;' class='material-icons'>image</i>
	    ناردنی وێنەی شاعیران
	</div>
    </div>

    <script>
     function check() {
         var poet = document.querySelector("#poetTxt");
         var txts = document.querySelectorAll("input, textarea");
         var btns = document.querySelectorAll("button[type=submit]");
         var upldlikebtn = document.getElementById("upldlikebtn");
         
         if(poet.value == "") {
             txts.forEach(function(e) {
                 e.style.borderTopColor = "";
                 e.style.background = "";
             });
             btns.forEach(function(e) {
                 e.style.background = "#777";
                 e.style.color = "#fff";
             });
             upldlikebtn.style.background = "";
             return;
         }

         var xmlhttp = new XMLHttpRequest();
         xmlhttp.onload = function() {
             var res = JSON.parse(this.responseText);
             
             if(res.id != "0") {
                 txts.forEach(function(e) {
                     e.style.borderTopColor = colors[color_num(res.id)][0];
                 });
                 btns.forEach(function(e) {
                     e.style.background = colors[color_num(res.id)][0];
                     e.style.color = colors[color_num(res.id)][1];
                 });
                 upldlikebtn.style.background = colors[color_num(res.id)][2];
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
                 upldlikebtn.style.background = "";
             }
         }
         xmlhttp.open("get", "isitnew.php?poet="+poet.value);
         xmlhttp.send();
     }
    </script>
    <style>
     .input-label-box {
	 display:flex;
	 margin:0 .5em;
     }
     .input-label-box label {
	 color:#444;
	 font-size:1em;
	 margin:auto .5em;
     }
    </style>
    
    <div style='font-size:.75em'>
        <?php echo @$uploaded; ?>
    </div>
    <!-- file upload sec -->
    <form id="frmUpload" method="POST" enctype="multipart/form-data" style="max-width:800px;margin:auto;padding-top:1em;font-size:0.7em">
	<div class="input-label-box">
            <input type="text" id="cntriTxt" name="cntri" style="font-size:1em;width:100%" value="<?php echo $_name1; ?>" placeholder="نێوی خۆتان لێرە بنووسن.">
	</div>
	<div class="input-label-box" style="margin:1em .5em">
	    <label for="poetTxt">شاعیر: </label>
            <input onblur="check()" type="text" id="poetTxt" name="poet" style="font-size:1em;width:94%;padding:1em 3%" value="<?php echo $_poet1; ?>" placeholder="نێوی شاعیر *">
	</div>
        
        <div class='file-btn button' role='button' onclick="document.querySelector('input[name=profile]').click()" style="display:inline-block;font-size: 1.7em;" id='upldlikebtn'>
            هەڵبژاردنی وێنە
        </div><br>
        <div style="padding-top:.2em;font-size:.7em; color:#555;font-family:'kurd',monospace">
            &bull; فۆرمەتی وێنەکەتان دەبێ 
            <span style='background:#eee;padding:0 .2em'>JPG, JPEG, PNG</span>
            بێت.
            <br>
            &bull; گەورەیی وێنەکە نابێ لە 
            <span style='background:#eee;padding:0 .2em'>5MB</span>
            زیاتر بێت.
        </div>
        <input type="file" style='display:none;' name="profile">
        <div id="frmUploadMess"></div>
        <button class='button bth' type="submit" style="width: 45%;max-width: 150px;background-color:#777;color:#fff;margin-top:1em;font-size: 1em;">ناردن</button>
    </form>
    <?php if(isset($_poet1)) { ?>
        <script>window.addEventListener("load",check)</script>
    <?php } ?>
    
    <div style="margin-top:2em;">
        <a class='button' href="image-list.php">
            ئەو وێنانەی کە ناردووتانە
        </a>
    </div>
    
    <script>
     // localStorage
     
     if(localStorage.getItem("contributor") !== null) {
         document.querySelector("#cntriTxt").value = JSON.parse(localStorage.getItem("contributor")).name || "";
     }
     
     ///
     document.querySelector("#frmUpload").addEventListener("submit", function(e) {
         
         e.preventDefault();
         
         var poetTxt = document.querySelector("#poetTxt");
         var nameTxt = document.querySelector("#cntriTxt");
         var fl = document.querySelector("input[name=profile]");
         var flbtn = document.querySelector(".file-btn");
         if(poetTxt.value == "") {
             poetTxt.focus();
             return;
         }
         if(fl.value == "") {
             var old_bkg = flbtn.style.background;
             flbtn.style.background = "rgba(204,51,0,0.2)";
             
             setTimeout(function() {
                 flbtn.style.background = old_bkg;
             }, 2000);
             return;
         }
         
         var frmts = ["image/jpeg", "image/png"];
         if(frmts.indexOf(fl.files[0].type) ==-1) {
             document.querySelector("#frmUploadMess").innerHTML = "<i style='background:rgba(204,51,0,0.1);color:#444;font-size:.7em;display:block;padding:0.3em'>ئەو شتەی هەڵتانبژاردووە وێنە نییە، وێنەیەک هەڵبژێرن.</i>";
             return;
         }
         if(fl.files[0].size > 5242880) {
             document.querySelector("#frmUploadMess").innerHTML = "<i style='background:rgba(204,51,0,0.1);color:#444;font-size:.7em;display:block;padding:0.3em'>نابێ گەورەیی وێنەکەتان لە 5MB زیاتر بێت.</i>";
             return;
         }
         
         //localStorage
         var email = "";
         if(localStorage.getItem("contributor") !== null) {
             var email = JSON.parse(localStorage.getItem("contributor")).ID || "";
         }
         localStorage.setItem("contributor", JSON.stringify({name: nameTxt.value, ID: email}));
         ///
         
         document.cookie = "poet="+poetTxt.value;
         document.cookie = "name="+nameTxt.value;
         
         document.querySelector("#frmUpload").submit();
         document.querySelector("#frmUploadMess").innerHTML="<div class='loader'></div>";
         
     });
    </script>
    
</div>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
