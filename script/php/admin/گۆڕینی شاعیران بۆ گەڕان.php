<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › گۆڕینی شاعیران بۆ گەڕان";
$desc = "گۆڕینی شاعیران بۆ گەڕان";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<style>
 .line {
	 text-align:right;
	 font-size:1.1em;
	 padding:0 1em;
 }
</style>
<div id="poets" style="font-size:.55em;text-align:right">
	<h1 style="font-size:2em" class="color-blue">
		گۆڕینی شاعیران بۆ گەڕان
	</h1>
	<?php
	/* Read */
	$q = "SELECT * FROM auth ORDER BY takh ASC";
	require_once("../condb.php");
	
	$aths_num = mysqli_num_rows($query);
	$aths = [];
	
	while($res = mysqli_fetch_assoc($query)) {
		$res["rtakh"] = $res["takh"];
		$res["name"] = san_data($res["name"]);
		$res["takh"] = san_data($res["takh"]);
		$res["profname"] = san_data($res["profname"]);
		$res["hdesc"] = san_data($res["hdesc"]);
		if(strlen($res["name"]) > strlen($res["hdesc"]))
			$res["len"] = strlen($res["name"]);
		else
			$res["len"] = strlen($res["hdesc"]);
		$aths[] = $res;
	}
	
	/* Write */
	$string = "<p class='line'>ئەژماری شاعیران: " .
		  num_convert($aths_num, "en", "ckb") .
		  "</p>";
	$error = false;
	mysqli_select_db($conn, _SEARCH_DB);
	mysqli_query($conn, "TRUNCATE TABLE poets");
	
	foreach($aths as $ath) {
		$id = $ath["id"];
		$name = $ath["name"];
		$takh = $ath["takh"];
		$profname = $ath["profname"];
		$hdesc = $ath["hdesc"];
		$rtakh = $ath["rtakh"];
		$len = $ath["len"];
		
		$query = mysqli_query(
			$conn,
			"INSERT INTO `poets`(`id`, `name`, `takh`," .
			" `profname`, `hdesc`, `rtakh`, `len`)" .
			" VALUES($id, '$name', '$takh'," .
			" '$profname', '$hdesc', '$rtakh', '$len')");
		
		if(!$query) {
			$error = true;
			$string .= "<p class='line'>" .
				   "<a class='link' " .
				   "href='/poet:$id'>" .
				   "$rtakh</a>: <b class=" .
				   "'color-red'>نەء!</b></p>";
		}
	}
	
	mysqli_close($conn);
	echo $string;
	
	if(!$error) {
		echo "<p class='line' style='text-align:center'>" .
		     "<b class='color-blue'>جێ بە جێیە.</b></p>";
	}
	?>
</div>
<?php
require_once("../footer.php");
?>
