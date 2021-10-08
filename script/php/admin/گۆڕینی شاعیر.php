<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › گۆڕینی شاعیر";
$desc = "گۆڕینی شاعیر";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<?php
if(isset($_REQUEST["id"]) &&
   filter_var($_REQUEST["id"], FILTER_VALIDATE_INT))
{
	/* Get poet info */
	$_id = $_REQUEST["id"];
	
	$q = "SELECT * FROM auth WHERE id=$_id";
	require_once("../condb.php");
	if(mysqli_num_rows($query) === 1)
		$_poet = mysqli_fetch_assoc($query);
	else
		$_id = 0;
	
	if($_id > 0) {
		/* Load poet info */
		$_name = $_poet["name"];
		$_takh = $_poet["takh"];
		$_profname = $_poet["profname"];
		$_hdesc = stripslashes($_poet["hdesc"]);
		$_bks = $_poet["bks"];
		$_bksdesc = stripslashes($_poet["bksdesc"]);
		
		$submitted = "<i class='color-blue'>دۆزیمە!</i>";
		
		/* If form has been submitted already */
		if(isset($_REQUEST["name"]) &&
		   isset($_REQUEST["takh"]) &&
		   isset($_REQUEST["profname"]) &&
		   isset($_REQUEST["bks"]))
		{
			$_name = $_REQUEST["name"];
			$_takh = $_REQUEST["takh"];
			$_profname = $_REQUEST["profname"];
			$_hdesc = addslashes($_REQUEST["hdesc"]);
			$_bks = $_REQUEST["bks"];
			$_bksdesc = addslashes($_REQUEST["bksdesc"]);
			
			/* Update poet info */
			$q = "UPDATE auth SET name='$_name'," .
			     " takh='$_takh', profname='$_profname'," .
			     " hdesc='$_hdesc', bks='$_bks'," .
			     " bksdesc='$_bksdesc' WHERE id=$_id";
			$query = mysqli_query($conn, $q);
			if($query) {
				$ver_file = "../../../desktop/" .
					    "update/index/" .
					    "update-version.txt";
				$ver_log = "../../../desktop/" .
					   "update/index/" .
					   "update-log.txt";
				
				$ver = @file_get_contents($ver_file);
				$ver = intval($ver) + 1;
    				file_put_contents($ver_file, $ver);
    				
    				$f = fopen($ver_log, "a");
    				$log = json_encode([
    					"ver" => $ver,
    					"poetID" => intval($_id)
				]) . "\n";
    				fwrite($f, $log);
    				fclose($f);
				
				$submitted = "<i class='color-blue'>" .
					     "ئەو شاعیرە بە ڕۆژ بۆوە" .
					     "</i>";
				
				$_hdesc = stripslashes(
					$_REQUEST["hdesc"]);
				$_bksdesc = stripslashes(
					$_REQUEST["bksdesc"]);
			} else {
				$submitted = "<i class='color-red'>" .
					     "کێشەیەک هەیە" .
					     "</i>";
			}
		}
		
		/* Load poet images */
		$_imgsrc = "../../../style/img/poets/profile/" .
			   "profile_{$_id}.jpg";
		if(!file_exists($_imgsrc)) {
			$_imgsrc = "../../../style/img/poets/" .
				   "profile/profile_0.jpg";
		}
		
		$uploaded = "<img id='profilepic' src='$_imgsrc'>";
		
		/* Check for uploads */
		if(isset($_FILES)) {
			$pro = [
				$_FILES["profile"],
				"../../../style/img/poets/" .
				"profile/profile_{$_id}.jpg"
			];
			
			if(move_uploaded_file($pro[0]["tmp_name"],
					      $pro[1]))
			{				
				$uploaded = "<i class='color-blue'>" .
					    "OK!</i><br><img src='" .
					    "{$pro[1]}' id='" .
					    "profilepic'>";

				$ver_file = "../../../desktop/" .
					    "update/imgs/" .
					    "update-version.txt";
				$ver_log = "../../../desktop/" .
					   "update/imgs/" .
					   "update-log.txt";
				
				$ver = @file_get_contents($ver_file);
				$ver = intval($ver) + 1;
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
	}
	mysqli_close($conn);
}
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
		گۆڕینی شاعیر
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
		       disabled>
		<input type="text"
		       name="name"
		       placeholder="ناوی شاعیر"
		       value="<?php echo $_name; ?>">
		<input type="text"
		       name="takh"
		       placeholder="ناسناو"
		       value="<?php echo $_takh; ?>">
		<input type="text"
		       name="profname"
		       placeholder="ناوی پرۆفایل"
		       value="<?php echo $_profname; ?>">
		<textarea name="hdesc"
			  placeholder="سەبارەت بە شاعیر"
		><?php echo $_hdesc; ?></textarea>
		<textarea name="bks"
			  placeholder="بەرهەمەکان"
		><?php echo $_bks; ?></textarea>
		<textarea name="bksdesc"
			  placeholder="سەبارەت بە بەرهەمەکان"
		><?php echo $_bksdesc; ?></textarea>
		<button type="submit" class="button">بەڕۆژ کردن</button>
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
