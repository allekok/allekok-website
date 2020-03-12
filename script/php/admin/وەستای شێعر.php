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
     const id = getPitewIdTxt.value;
     const request = '/script/php/admin/get-pitew.php?id='+id;
     getUrl(request, function (response) {
	 response = isJson(response);
	 if(!response) return;

	 document.getElementById('name').value = response.poemName;
	 document.getElementById('hdesc').value = 'نووسین: '+response.contributor;
	 document.getElementById('hon').value = response.poem;
     });
     localStorage.setItem('pitew-id', id);
 }
 
 function num_convert() {
     const en_num = [/0/g,/1/g,/2/g,/3/g,/4/g,/5/g,/6/g,/7/g,/8/g,/9/g],
	   fa_num = [/۰/g,/۱/g,/۲/g,/۳/g,/۴/g,/۵/g,/۶/g,/۷/g,/۸/g,/۹/g],
	   ku_num = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
     
     const not_allow = [
	 /\"/g, /&#34;/g,/&#۳۴;/g,
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
     font-size:18px;
 }
 
 form {
     width:100%;
     max-width:1000px;
     margin:0 auto;
 }
 
 input[type=text], textarea {
     width:100%;
     margin:auto;
     display:block;
 }
 
 input[type=text] {
     margin-bottom:15px;
 }
 input[name=row] {
     text-align:left;
 }
 textarea {
     height:30em;
     min-height:30em;
     margin-bottom:20px;
     max-width:100%;
     direction:ltr;
     text-align:left;
 }
 .not {
     padding:10px 5px;
     margin:0 auto 10px;
     text-align:center;
 }
 .r {
     background-color:rgba(255,0,0,0.1);
 }
 .g {
     background-color:rgba(0,255,0,0.1);
 }
 select {
     width:60%;
     padding:5px 1.5%;
     margin-right:20px;
     border-radius:1em;
     outline:0;
     border:2px solid #fff;
     margin-bottom:10px;
     background:#000;
     color:#fff;
 }
 #poets button {
     margin:15px .5%;
     padding:10px 0;
     border:2px solid <?php echo $_color_black; ?>;
     border-radius:1em;
     cursor:pointer;
     width:24%;
     text-align:center;
     float:right;
     font-weight:bold;
 }
 
 #poets a {
     padding: 0.15em 0 0.05em;
     text-align: center;
     font-size:1em;
     margin:0 1em;
 }
 #toolbox {
     text-align:center;
     padding:1em 0;
 }
 #tools {
     text-align:center;
 }
 #tools button {
     width:auto;
     padding:0.2em 0.4em;
     font-size:0.7em;
     margin:0 0.2em 0.5em;
 }
</style>

<div id="poets">
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
<br>
<a style='display:block' href='/{$link}' target='_blank'>$link</a>
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
<br>
<a style='display:block' href='/{$link}' target='_blank'>$link</a>
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
<br>
<a style='display:block' href='/{$link}' target='_blank'>$link</a>
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

    <form method='POST' id='frmbash'>
	شاعیر: 
	<select name='db' onchange='form.submit()'>
	    <option value=''></option>
	    <?php
	    $db = _DEFAULT_DB;
	    $q='SELECT * FROM auth';
	    require(ABSPATH.'script/php/condb.php');
	    if(mysqli_num_rows($query)) {
		while($row=mysqli_fetch_assoc($query)) {
	    ?>
	    <option value="tbl<?php echo $row['id'] ?>" <?php $seldb="tbl" . $row['id']; if($dbcache == $seldb) { echo 'selected'; }?>>
		<?php echo $row['profname']; ?>
	    </option>
	    
	    <?php } } mysqli_close($conn); ?>
	</select>
	<br />
	کتێب: 
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
			echo("<option value='_" . $b . "' " . $seltbllabel . ">" . $rbks[$i] . "</option>");
			$seltbllabel = "";
		    }
		}
	    }
	    mysqli_close($conn);
	    ?>
	</select>
	<br />
	<input placeholder='ژمارەی شیعر' id='row' name='row' type='text' value="<?php  echo $rowd;  ?>" />
	<input placeholder='ناوی شیعر' id='name' name='name' type='text' value="<?php  echo $name;  ?>" />
	<div id="search-res"></div>
	<input placeholder='لە بارەی ئەم شیعرەدا' id='hdesc' name='hdesc' type='text' value="<?php  echo $hdesc;  ?>" />
	<div style='text-align:center'>
	    <button type='button' onclick="next()">دوایی</button>
	    
	    <button type='submit'><?php echo $butt; ?></button>
	    
	    <button type='button' onclick="newr()">تازە</button>
	    
	    <button type='button' onclick="back()">پێشوو</button>
	</div>
	
	<div id="tools">
	    <button class='button' type='button' onclick="make_mdcf()">m d cf</button><button class='button' type='button' onclick="make_b()">b</button><button class='button' type='button' onclick="make_n()">n</button><button class='button' type='button' onclick="make_mptr()">m ptr</button><button class='button' type='button' onclick="make_ptrptrh()">ptr ptrh</button><button class='button' type='button' onclick="nbr_convert()" style="direction:ltr">\n -> br</button><button class='button' type='button' onclick="make_sup()">sup</button><button class='button' type='button' onclick="num_convert()">ژمارەی کوردی</button><button class="button" type="button" onclick="chDirection()">RTL<>LTR</button>
		<input type="text" id="getPitewIdTxt" placeholder="Pitew id" />
		<button type="button" id="getPitewBtn" onclick="getPitew()">getPitew</button>
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
