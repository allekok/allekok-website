<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › شاعیری نوێ";
$desc = "زیادکردنی شاعیرێکی نوێ";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<?php
/* Get the new id */
$q = "SELECT id FROM auth ORDER BY id DESC";
require_once("../condb.php");
if($query)
	$_id = mysqli_fetch_assoc($query)["id"] + 1;

/* Upload image */
if(isset($_FILES)) {
	$img = [
		$_FILES["profile"],
		"../../../style/img/poets/profile/profile_{$_id}.jpg"
	];
	if(!file_exists($img[1]) &&
	   move_uploaded_file($img[0]["tmp_name"], $img[1]))
	{
		$uploaded = "<i class='color-blue'>خاسە.</i>" .
			    "<br>" .
			    "<img src='{$img[1]}' " .
			    "id='profilepic'>";
		
		$ver_file = "../../../desktop/update/imgs/" .
			    "update-version.txt";
		$ver_log = "../../../desktop/update/imgs/" .
			   "update-log.txt";
		$ver = intval(file_get_contents($ver_file)) + 1;
    		file_put_contents($ver_file, $ver);
    		$f = fopen($ver_log, "a");
    		$log = json_encode([
			"ver" => $ver,
    			"poetID" => intval($_id)
		]) . "\n";
    		fwrite($f, $log);
    		fclose($f);
	}
}

/* Submit new poet */
if(isset($_REQUEST["name"]) &&
   isset($_REQUEST["takh"]) &&
   isset($_REQUEST["profname"]) &&
   isset($_REQUEST["bks"]) &&
   isset($_REQUEST["kind"]))
{
	$_name = $_REQUEST["name"];
	$_takh = $_REQUEST["takh"];
	$_profname = $_REQUEST["profname"];
	$_hdesc = $_REQUEST["hdesc"];
	$_bks = $_REQUEST["bks"];
	$_bksdesc = $_REQUEST["bksdesc"];
	$_kind = $_REQUEST["kind"];
	
	$q = "INSERT INTO auth " .
	     "(id, name, takh, profname," .
	     " hdesc, bks, bksdesc, kind)" .
	     " VALUES($_id, '$_name', '$_takh', '$_profname'," .
	     " '$_hdesc', '$_bks', '$_bksdesc', '$_kind')";
	$query = mysqli_query($conn, $q);
	if($query) {
		$ver_file = "../../../desktop/update/index/" .
			    "update-version.txt";
		$ver_log = "../../../desktop/update/index/" .
			   "update-log.txt";
		$ver = intval(file_get_contents($ver_file)) + 1;
		file_put_contents($ver_file, $ver);
		$f = fopen($ver_log, "a");
		$log = json_encode([
			"ver" => $ver,
			"poetID" => intval($_id),
		]) . "\n";
		fwrite($f, $log);
		fclose($f);
		
		$submitted = "<i class='color-blue'>" .
			     "ئەو شاعیرە بە ئاڵەکۆکەوە زیاد کرا." .
			     "</i>"; 
		
		$_id++;
	} else {
		$submitted = "<i class='color-red'>" .
			     "کێشەیەک هەیە." .
			     "</i>";
	}
}
mysqli_close($conn);
?>
<style>
 input[type=text], textarea {
	 font-size:1.1em;
	 display: block;
	 width:100%;
	 max-width:100%;
	 font-family:"kurd", mono;
	 margin-bottom:1rem;
 }
 input[type=file] {
	 margin-bottom:1rem;
 }
 textarea {
	 height:10em;
 }
 button[type=submit] {
	 display:block;
	 width:100%;
	 max-width:100px;
	 padding:1rem 0;
	 margin:auto;
	 text-align:center;
	 font-size:1em;
 }
 #frmInfo {
	 width:100%;
	 max-width:1000px;
	 margin:auto auto 1em;
	 padding:2rem 1rem 3rem;
	 border-bottom:1px solid;
 }
 #frmUpload {
	 text-align:center;
	 padding:2rem 1rem 3rem;
	 direction:ltr;
	 font-family:"kurd", mono;
 }
 #frmInfoMess, #frmUploadMess {
	 width:100%;
	 max-width:1000px;
	 margin:auto;
	 text-align:center;
 }
</style>
<div id="poets" style="font-size:.55em;text-align:right">
	<h1 style="font-size:2em" class="color-blue">
		شاعیری نوێ
	</h1>
	
	<!-- Info message -->
	<div id="frmInfoMess">
		<?php echo $submitted; ?>
	</div>

	<!-- Info form -->
	<form id="frmInfo" method="POST">
		<input type="text"
		       name="id"
		       placeholder="ژمارەی شاعیر"
		       value="<?php echo $_id; ?>"
		       style="direction:ltr;text-align:center"
		       disabled>
		<input type="text"
		       name="name"
		       placeholder="ناوی شاعیر">
		<input type="text"
		       name="takh"
		       placeholder="ناسناو">
		<input type="text"
		       name="profname"
		       placeholder="ناوی پرۆفایل">
		<textarea name="hdesc"
			  placeholder="سەبارەت بە شاعیر"></textarea>
		<textarea name="bks"
			  placeholder="بەرهەمەکان"></textarea>
		<textarea name="bksdesc"
			  placeholder="سەبارەت بە بەرهەمەکان"></textarea>
		<input type="text"
		       name="kind"
		       placeholder="جۆر: dead | alive | pending"
		       style="direction:ltr;text-align:center">
		<button type="submit" class="button">زیاد کردن</button>
	</form>
	
	<!-- File upload form -->
	<h1 style="font-size:2em" class="color-blue">
		وێنەی شاعیر
	</h1>
	<form id="frmUpload"
	      method="POST"
	      enctype="multipart/form-data">
		<input type="file" name="profile" id="profile">
		<button type="submit" class="button">ناردن</button>
		<div id="frmUploadMess">
			<?php echo $uploaded; ?>
		</div>
	</form>
</div>
<?php
require_once("../footer.php");
?>
