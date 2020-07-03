<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; وەستای شێعر";
$desc = "وەستای شێعر";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<script>
 document.querySelector("header").style.display = "none";
 window.onload = () =>
	 document.querySelector("footer").style.display = "none";
 document.body.style.padding = "0 1em";
 function chDirection() {
	 var poem = document.getElementById("hon");
	 if(poem.style.direction=="rtl") {
		 poem.style.direction = "ltr";
		 poem.style.textAlign = "left";
	 } else {
		 poem.style.direction = "rtl";
		 poem.style.textAlign = "right";
	 }
 }
 function newr() {
	 document.getElementById("hon").value = "";
	 document.getElementById("row").value = "";
	 document.getElementById("name").value = "";
	 document.getElementById("hdesc").value = "";
	 document.getElementById("frmbash").submit();
 }	     
 function next() {
	 document.getElementById("hon").value = "";
	 var id = parseInt(document.getElementById("row").value)+1;
	 document.getElementById("row").value = id;
	 document.getElementById("name").value = "";
	 document.getElementById("hdesc").value = "";
	 document.getElementById("frmbash").submit();
 }
 function back() {
	 document.getElementById("hon").value = "";
	 var id = parseInt(document.getElementById("row").value)-1;
	 document.getElementById("row").value = id;
	 document.getElementById("name").value = "";
	 document.getElementById("hdesc").value = "";
	 document.getElementById("frmbash").submit();
 }
 ////////////
 function make_mdcf() {
	 var inp = document.querySelector("#hon");
	 var start = inp.selectionStart;
	 var end = inp.selectionEnd;
	 var sel = inp.value.substring(start,end)
	 if(sel != "" || inp.value == "") {
		 
		 var out = "<div class='m d cf'>\n" + sel + "\n</div>";
		 
		 var part1 = inp.value.substring(0, start);
		 var part2 = inp.value.substr(end);
		 
		 out = part1 + out + part2;
		 
		 inp.value = out;
	 }
	 inp.focus();
 }
 function make_b() {
	 var inp = document.querySelector("#hon");
	 var start = inp.selectionStart;
	 var end = inp.selectionEnd;
	 var sel = inp.value.substring(start,end)
	 if(sel != "" || inp.value == "") {
		 
		 var out = "<div class='b'>\n" + sel + "\n</div>";
		 
		 var part1 = inp.value.substring(0, start);
		 var part2 = inp.value.substr(end);
		 
		 out = part1 + out + part2;
		 
		 inp.value = out;
	 }
	 inp.focus();
 }
 function make_n() {
	 var inp = document.querySelector("#hon");
	 var start = inp.selectionStart;
	 var end = inp.selectionEnd;
	 var sel = inp.value.substring(start,end)
	 if(sel != "" || inp.value == "") {
		 
		 var out = "<div class='n'><div class='m'>\n" + sel + "\n</div></div>";
		 
		 var part1 = inp.value.substring(0, start);
		 var part2 = inp.value.substr(end);
		 
		 out = part1 + out + part2;
		 
		 inp.value = out;
	 }
	 inp.focus();
 }
 function make_mptr() {
	 var inp = document.querySelector("#hon");
	 var start = inp.selectionStart;
	 var end = inp.selectionEnd;
	 var sel = inp.value.substring(start,end)
	 if(sel != "" || inp.value == "") {
		 
		 var out = "<div class='m'><div class='ptr'>\n" + sel + "\n</div></div>";
		 
		 var part1 = inp.value.substring(0, start);
		 var part2 = inp.value.substr(end);
		 
		 out = part1 + out + part2;
		 
		 inp.value = out;
	 }
	 inp.focus();
 }
 function make_ptrptrh() {
	 var inp = document.querySelector("#hon");
	 var start = inp.selectionStart;
	 var end = inp.selectionEnd;
	 var sel = inp.value.substring(start,end)
	 if(sel != "" || inp.value == "") {
		 
		 var out = "<div class='ptr ptrh'>\n" + sel + "\n</div>";
		 
		 var part1 = inp.value.substring(0, start);
		 var part2 = inp.value.substr(end);
		 
		 out = part1 + out + part2;
		 
		 inp.value = out;
	 }
	 inp.focus();
 }

 function getPitew ()
 {
	 const getPitewIdTxt = document.getElementById('getPitewIdTxt');
	 const setPitewStatusTxt = document.getElementById('setPitewStatusTxt');
	 const setPitewAdrsTxt = document.getElementById('setPitewAdrsTxt');
	 const setPitewDescTxt = document.getElementById('setPitewDescTxt');
	 const pitewPoet = document.getElementById('pitewPoet');
	 const pitewBook = document.getElementById('pitewBook');
	 const id = getPitewIdTxt.value;
	 const request = '/script/php/admin/get-pitew.php?id='+id;
	 getUrl(request, function (response) {
		 response = isJson(response);
		 if(!response) return;
		 
		 document.getElementById('name').value = response.poemName;
		 document.getElementById('hdesc').value = 'نووسین: '+response.contributor;
		 document.getElementById('hon').value = response.poem;
		 setPitewStatusTxt.value = response.status;
		 setPitewAdrsTxt.value = response.adrs;
		 setPitewDescTxt.value = response.desc;
		 pitewPoet.innerText = response.poet;
		 pitewBook.innerText = response.book;
	 });
	 localStorage.setItem('pitew-id', id);
 }
 let setPitewBtn, originSetPitewBtn;
 window.addEventListener("load", function () {
	 setPitewBtn = document.getElementById('setPitewBtn');
	 originSetPitewBtn = setPitewBtn.innerHTML;
 })
 function setPitew ()
 {
	 const getPitewIdTxt = document.getElementById('getPitewIdTxt');
	 const setPitewStatusTxt = document.getElementById('setPitewStatusTxt');
	 const setPitewAdrsTxt = document.getElementById('setPitewAdrsTxt');
	 const setPitewDescTxt = document.getElementById('setPitewDescTxt');
	 const id = getPitewIdTxt.value;
	 const status = setPitewStatusTxt.value.trim()
	 const adrs = setPitewAdrsTxt.value.trim()
	 const desc = encodeURIComponent(setPitewDescTxt.value.trim())
	 const request = '/script/php/admin/set-pitew.php?id='+id+
			 '&status='+status+'&adrs='+adrs+'&desc='+desc;
	 getUrl(request, function (response) {
		 if(response == '1')
			 setPitewBtn.innerHTML = '<i class="material-icons color-blue">check</i>';
		 else
			 setPitewBtn.innerHTML = '<i class="material-icons color-red">close</i>"';
		 setTimeout(function () {
			 setPitewBtn.innerHTML = originSetPitewBtn;
		 }, 3000);
	 });
 }
 
 function num_convert() {
	 const en_num = [/0/g,/1/g,/2/g,/3/g,/4/g,/5/g,/6/g,/7/g,/8/g,/9/g],
	       fa_num = [/۰/g,/۱/g,/۲/g,/۳/g,/۴/g,/۵/g,/۶/g,/۷/g,/۸/g,/۹/g],
	       ku_num = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
	 
	 const not_allow = [
		 /\"/g, /&#3[49];/g, /&#۳[۴٩];/g,
	     ];
             const allowed = ["\'", "\'","\'"];
	     
	     var input = document.querySelector('#hon');
	     var output = input.value;
	     
	     for(var o in not_allow) {
		 output = output.replace(not_allow[o], allowed[o]);
	     }
	     
	     for(var en in en_num) {
		 
		 output = output.replace(en_num[en], ku_num[en]);
		 output = output.replace(fa_num[en], ku_num[en]);
		 
	     }
	     
	     input.value = output;
	 }
	 function nbr_convert() {
	     
	     var input = document.querySelector('#hon');
		 var output = input.value;
		 
		 output = output.replace(/\n/g, "<br>\n");
		 
		 input.value = output;
 }
		 function make_sup() {
			 var inp = document.querySelector("#hon");
			 var start = inp.selectionStart;
			 var end = inp.selectionEnd;
			 var sel = inp.value.substring(start,end)
			 if(sel != "" || inp.value == "") {
				 
				 var out = "<sup>" + sel + "</sup>";
				 
				 var part1 = inp.value.substring(0, start);
				 var part2 = inp.value.substr(end);
				 
				 out = part1 + out + part2;
				 
				 inp.value = out;
			 }
			 inp.focus();
		 }
</script>
<style>
 #poets * {
	 font-size:14px;
 }
 
 form {
	 width:100%;
 }
 
 input[type=text], textarea {
	 width:100%;
	 margin:auto;
	 display:block;
 }
 
 input[type=text] {
	 margin-bottom:.2em;
	 padding:.5em 1em;
	 border-radius:.5em
 }
 input[name=row] {
	 text-align:center;
	 direction:ltr;
 }
 textarea {
	 height:27em;
	 max-width:100%;
	 direction:ltr;
	 text-align:left;
 }
 .not {
	 text-align:center;
	 display:inline-block;
 }
 .r {
	 color:<?php echo $_colors[3] ?>;
 }
 .g {
	 color:<?php echo $_colors[2] ?>;
 }
 select {
	 width:100%;
	 margin-right:20px;
	 border-radius:.5em;
	 outline:0;
	 border:2px solid <?php echo $_colors[1]; ?>;
	 margin-left:1em;
	 background:<?php echo $_colors[0]; ?>;
	 color:<?php echo $_colors[1]; ?>;
 }
 #poets button {
	 margin:0 .5% .2em;
	 border:2px solid <?php echo $_colors[1]; ?>;
	 border-radius:.5em;
	 width:24%;
	 text-align:center;
	 float:right;
	 font-weight:bold;
 }
 
 #poets a {
	 text-align: center;
	 margin:0 1em;
 }
 #toolbox {
	 text-align:right;
	 display:inline-block
 }
 #tools {
	 text-align:center;
 }
 #tools button {
	 width:auto;
	 padding:0 0.4em;
	 font-size:0.7em;
	 margin:0 0.2em 0.5em;
 }
</style>
<div id="poets">
	<div>
		<div id="toolbox">
			<a onclick="event.preventDefault();window.open('<?php echo _SITE; ?>script/php/admin/sitemap.php', '_blank','width=300,height=320','')" href="sitemap.php">
				زیاد کردن
			</a><a onclick="event.preventDefault();window.open('<?php echo _SITE; ?>script/php/admin/search-poems.php', '_blank','width=300,height=320','')" href="search-poems.php">
				دروست کردن
			</a>
		</div>
		
<?php
function tbl_name_to_address($_tbl) {
	$_tbl = explode("_", $_tbl);
	return "poet:".substr($_tbl[0],3)."/book:".$_tbl[1];
}
$butt = 'ناردن';
$dbcache = $_REQUEST['db'];
$db = $_REQUEST['db'];
$tblcache = $_REQUEST['tbl'];
$rowd = $_REQUEST['row'];
$name = trim($_REQUEST['name']);
$hdesc = trim($_REQUEST['hdesc']);
$hon = $_REQUEST['hon'];
$hon=stripslashes($hon);

$_tbl = $db . $tblcache;

if($dbcache=='') {
	echo("<div class='not r'>
			شاعیرێک هەڵبژێرە.
			</div>");
} elseif($dbcache!='' && $tblcache=='') {
	echo("<div class='not r'>
			بەرهەمێک هەڵبژێرە.
			</div>");
} elseif($dbcache!='' && $tblcache!='' && $rowd=='') {
	echo("<div class='not r'>
			  ژمارەی شیعرێک بنوسە.
			</div>");
	$q='SELECT * FROM ' . $_tbl;
	$conn = mysqli_connect(_HOST, _USER, _PASS);
	mysqli_select_db($conn,_DEFAULT_DB);
	mysqli_set_charset($conn,"utf8");
	$query = mysqli_query($conn, $q);
	
	$rowd=mysqli_num_rows($query)+1;
	mysqli_close($conn);
} elseif($dbcache!='' && $tblcache!='' && $rowd!='') {
	$pre_link = tbl_name_to_address($_tbl);
	$q = 'SELECT * FROM ' . $_tbl . ' WHERE id=' . $rowd;
	$conn = mysqli_connect(_HOST, _USER, _PASS);
	mysqli_select_db($conn,_DEFAULT_DB);
	mysqli_set_charset($conn,"utf8");
	$query = mysqli_query($conn, $q);
	
	mysqli_close($conn);
	if(mysqli_num_rows($query)>0) {
		if($_REQUEST['hon']=='') {
			$res = mysqli_fetch_assoc($query);
			$name=$res['name']; $hdesc=$res['hdesc']; $hon=stripslashes($res['hon']);
			$link = $pre_link . "/poem:{$res["id"]}";
			echo("<div class='not g'>
					دۆزیمەوە!
<a href='"._R."{$link}' target='_blank'>$link</a>
					</div>");
		} else {
			$q = "UPDATE `" . $_tbl . "` SET `id`=$rowd,`name`='$name',`hon`=" . '"'.$hon . '"' . ",`hdesc`='$hdesc' WHERE id=" . $rowd;
			$conn = mysqli_connect(_HOST, _USER, _PASS);
			mysqli_select_db($conn,_DEFAULT_DB);
			mysqli_set_charset($conn,"utf8");
			$query = mysqli_query($conn, $q);
			
			mysqli_close($conn);
			if($query) {
				$link = $pre_link . "/poem:{$rowd}";
				echo("<div class='not g'>
						شیعرەکە بەڕۆژ بۆوە!
<a href='"._R."{$link}' target='_blank'>$link</a>
						</div>");
				
				$f = fopen("../../../desktop/update/books/update-version.txt","r+");
				$old_ver = fread($f, filesize("../../../desktop/update/books/update-version.txt"));
				fseek($f, 0);
				$new_ver = 1+intval($old_ver);
				fwrite($f, $new_ver);
				fclose($f);
				
				$f = fopen("../../../desktop/update/books/update-log.txt","a");
				$f2 = fopen("../../../pitew/news.txt","r+");
				$now = date("Y-m-d H:i:s");
				$log = [
					"ver" => $new_ver,
					"poetID" => intval(substr($db, 3)),
					"bookID" => intval(substr($tblcache, 1)),
					"poemID" => $rowd,
					"op" => "edit",
					"date"=>$now,
				];
				$log = json_encode($log) . "\n";
				fwrite($f, $log);
				$old_f2 = file_get_contents("../../../pitew/news.txt");
				fwrite($f2, $log . $old_f2);
				fclose($f);
				fclose($f2);
				
			} else {
				echo("<div class='not r'>
						موشکیلێک لە بەڕۆژ کردنی ئەم شیعرەدا هاتۆتە پێش. تکایە بە بەڕێوبەری ئاڵەکۆک ڕای بگەیێنن.
						</div>");
			}
			
		}
	} else {
		$q = "INSERT INTO `" . $_tbl . "`(`id`, `name`, `hon`, `hdesc`) VALUES ($rowd,'$name',".'"'.$hon.'"'.",'$hdesc')";
		$conn = mysqli_connect(_HOST, _USER, _PASS);
		mysqli_select_db($conn,_DEFAULT_DB);
		mysqli_set_charset($conn,"utf8");
		$query = mysqli_query($conn, $q);
		
		if($query) {
			$link = $pre_link . "/poem:{$rowd}";
			echo("<div class='not g'>
					ئەم شیعرە بە ئاڵەکۆکەوە زیادکرا!
<a href='/{$link}' target='_blank'>$link</a>
					</div>");
			
			$f = fopen("../../../desktop/update/books/update-version.txt","r+");
			$old_ver = fread($f, filesize("../../../desktop/update/books/update-version.txt"));
			fseek($f, 0);
			$new_ver = 1+intval($old_ver);
			fwrite($f, $new_ver);
			fclose($f);
			
			$f = fopen("../../../desktop/update/books/update-log.txt","a");
			$f2 = fopen("../../../pitew/news.txt","r+");
			$now = date("Y-m-d H:i:s");
			$log = [
				"ver" => $new_ver,
				"poetID" => intval(substr($db, 3)),
				"bookID" => intval(substr($tblcache, 1)),
				"poemID" => $rowd,
				"op" => "add",
				"date"=>$now,
			];
			$log = json_encode($log) . "\n";
			fwrite($f, $log);
			$old_f2 = file_get_contents("../../../pitew/news.txt");
			fwrite($f2, $log . $old_f2);
			fclose($f);
			fclose($f2);
			
		} else {
			echo("<div class='not r'>
					لە زیادکردنی ئەم شیعرەدا موشکیلێک هاتۆتە پێش. تکایە بە بەڕێوبەری ئاڵەکۆک ڕای بگەیێنن.
					</div>");
		}
		mysqli_close($conn);
	}
}
?>
	</div>
	<form method='POST' id='frmbash'>
		<div style="display:flex;margin-bottom:.5em">
			<p id="pitewPoet">شاعیر: </p>
			<select name='db' onchange='form.submit()'>
				<option value=''></option>
				<?php
				$db = _DEFAULT_DB;
				$q='SELECT * FROM auth ORDER BY takh ASC';
				require(ABSPATH.'script/php/condb.php');
				if(mysqli_num_rows($query)) {
					while($row=mysqli_fetch_assoc($query)) {
				?>
					<option value="tbl<?php echo $row['id'] ?>" <?php $seldb="tbl" . $row['id']; if($dbcache == $seldb) { echo 'selected'; }?>>
						<?php echo $row['takh']; ?>
					</option>
					
				<?php } } mysqli_close($conn); ?>
			</select>
			<p id="pitewBook">کتێب: </p>
			<select name='tbl'>
				<?php
				$db = _DEFAULT_DB;
				$q = 'SELECT * FROM auth WHERE id='. substr($dbcache,3);
				require(ABSPATH.'script/php/condb.php');
				if($query) {
					$row = mysqli_fetch_assoc($query);
					$rbks = explode(',',$row['bks']);
					for($i=0;$i<count($rbks);$i++) {
						if($rbks[$i]!=='') {
							$b = $i+1;
							$seltbl="_" . $b; if($tblcache == $seltbl) { $seltbllabel='selected'; }
							echo("<option value='_" . $b . "' " . $seltbllabel . ">" . num_convert($i+1,"en","ckb") . 
							     ". " . $rbks[$i] . "</option>");
							$seltbllabel = "";
						}
					}
				}
				mysqli_close($conn);
				?>
			</select>
		</div>
		<div style="display:flex">
			<input style="width:15%;margin-left:.2em" placeholder='ژمارە' id='row' name='row' type='text' value="<?php  echo $rowd;  ?>" />
			<input placeholder='ناوی شیعر' id='name' name='name' type='text' value="<?php  echo $name;  ?>" />
		</div>
		<input placeholder='لە بارەی ئەم شیعرەدا' id='hdesc' name='hdesc' type='text' value="<?php  echo $hdesc;  ?>" />
		<div style='text-align:center'>
			<button type='button' onclick="next()">دوایی</button>
			
			<button type='submit'><?php echo $butt; ?></button>
			
			<button type='button' onclick="newr()">تازە</button>
			
			<button type='button' onclick="back()">پێشوو</button>
		</div>
		
		<div id="tools">
			<button class='button' type='button' onclick="make_mdcf()">m d cf</button><button class='button' type='button' onclick="make_b()">b</button><button class='button' type='button' onclick="make_n()">n</button><button class='button' type='button' onclick="make_mptr()">m ptr</button><button class='button' type='button' onclick="make_ptrptrh()">ptr ptrh</button><button class='button' type='button' onclick="nbr_convert()" style="direction:ltr">\n -> br</button><button class='button' type='button' onclick="make_sup()">sup</button><button class='button' type='button' onclick="num_convert()">ژمارەی کوردی</button><button class="button" type="button" onclick="chDirection()">RTL<>LTR</button>
				<div style="display:flex;width:100%;margin-bottom:.5em;border:1px solid;border-radius:.5em">
					<input style="margin:0;border:0" type="text" id="getPitewIdTxt" placeholder="پتەو-ژمارەی شێعری ناردراو" />
					<button style="margin:0 .5em 0 0;border:0;padding:0 2em" type="button" id="getPitewBtn" onclick="getPitew()">وەرگرتن</button>
				</div>
				<div style="display:flex;width:100%;margin-bottom:.5em;border:1px solid;border-radius:.5em">
					<input style="margin:0;border:0" type="text" id="setPitewStatusTxt" placeholder="پتەو-وەزعیەت: ٢-، ١-، ٠، ١" 
					       <?php  
					       if($link) echo " value='1' ";
					       ?>/>
					<input style="margin:0;border:0;direction:ltr;text-align:left" type="text" id="setPitewAdrsTxt" placeholder="پتەو-نیشانی" 
					       <?php 
					       if($link) echo "value='$link'";
					       ?>/>
					<input style="margin:0;border:0" type="text" id="setPitewDescTxt" placeholder="پتەو-سەبارەت" />
					<button style="margin:0 .5em 0 0;border:0;padding:0 2em" type="button" id="setPitewBtn" onclick="setPitew()">ناردن</button>
				</div>
				<script>
				 const getPitewIdTxt = document.getElementById('getPitewIdTxt');
				 getPitewIdTxt.value = localStorage.getItem('pitew-id');
				 getPitewIdTxt.onkeydown = function (e)
				 {
					 if(e.keyCode == 13)
					 {
						 e.preventDefault();
						 getPitew();
					 }
				 }
				</script>
		</div>
		<textarea placeholder='شیعر' id='hon' name='hon'><?php echo $hon; ?></textarea><br />	
	</form>    
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
