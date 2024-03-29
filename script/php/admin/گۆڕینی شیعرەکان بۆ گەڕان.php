<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › گۆڕینی شیعرەکان بۆ گەڕان";
$desc = "گۆڕینی شیعرەکان بۆ گەڕان";
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
		گۆڕینی شیعرەکان بۆ گەڕان
	</h1>
	<?php
	/* Read */
	$q = "SELECT * FROM auth ORDER BY takh ASC";
	require_once("../condb.php");
	$aths_num = mysqli_num_rows($query);
	$bks_num = 0;
	$pms_num = 0;
	$aths = [];
	while($res = mysqli_fetch_assoc($query)) {
		$res["bks"] = explode(",", $res["bks"]);
		$bks_num += count($res["bks"]);
		$aths[] = $res;
	}

	/* Save Cipi column */
	mysqli_select_db($conn, _SEARCH_DB);
	$query = mysqli_query($conn,
			      "SELECT poet_id, book_id, poem_id," .
			      " Cipi FROM poems");
	$Cs = [];
	if($query) {
		while($res = mysqli_fetch_assoc($query)) {
			$idx = "{$res['poet_id']}/" .
			       "{$res['book_id']}/" .
			       "{$res['poem_id']}";
			$Cs[$idx] = $res["Cipi"];
		}
	}
	
	/* Write */
	mysqli_query($conn, "TRUNCATE TABLE poems");

	$error = false;
	$string = "";
	$poems = [];
	$Cs_key = 0;

	foreach($aths as $ath) {
		$rtakh = $ath["takh"];
		$poet_id = $ath["id"];
		for($i = 0; $i < count($ath["bks"]); $i++) {
			$rbook = $ath["bks"][$i];
			$book_id = $i + 1;
			mysqli_select_db($conn, _DEFAULT_DB);
			$_tbl = "tbl{$poet_id}_{$book_id}";
			$query = mysqli_query($conn,
					      "SELECT * FROM $_tbl");
			$pms_num += mysqli_num_rows($query);
			while($res = mysqli_fetch_assoc($query)) {
				$res["poet_id"] = $poet_id;
				$res["book_id"] = $book_id;
				$res["rname"] = $res["name"];
				$res["name"] = san_data($res["name"]);
				$res["hon"] = preg_replace(
					"/<sup>.*<\/sup>/ui",
					"",
					$res["hon"]);
				$res["hon"] = san_data($res["hon"]);
				$res["hon_true"] = san_data_more(
					$res["hon"]);
				$res["hdesc"] = san_data(
					$res["hdesc"]);
				if(strlen($res["hon"]) >
					strlen($res["hdesc"]))
				{
					$res["len"] = strlen(
						$res["hon"]);
				} else {
					$res["len"] = strlen(
						$res["hdesc"]);
				}
				$res = array_merge(["rbook" => $rbook],
						   $res);
				$res = array_merge(["rtakh" => $rtakh],
						   $res);
				$idx = "$poet_id/" .
				       "$book_id/" .
				       $res['id'];
				$cipi = @intval($Cs[$idx]);
				array_unshift($res, $cipi);
				$poems[] = $res;
			}
			rsort($poems);
		}
	}
	
	mysqli_select_db($conn, _SEARCH_DB);
	foreach($poems as $pm) {
		$poet_id = $pm["poet_id"];
		$book_id = $pm["book_id"];
		$rtakh = $pm["rtakh"];
		$rbook = $pm["rbook"];
		$pname = $pm["name"];
		$phon = $pm["hon"];
		$phon_true = $pm["hon_true"];
		$phdesc = $pm["hdesc"];
		$poem_id = $pm["id"];
		$rname = $pm["rname"];
		$phonlen = $pm["len"];
		$Cipi = $pm[0];
		
		$q = "INSERT INTO `poems`(`name`, `hdesc`, " .
		     "`poet_id`, `book_id`, `poem_id`, `poem`, " .
		     "`rname`, `rbook`, `rtakh`, `Cipi`, `len`, " .
		     "`poem_true`) VALUES ('$pname', '$phdesc', " .
		     "'$poet_id', '$book_id', '$poem_id', " .
		     '"' . $phon . '"' .
		     ", '$rname', '$rbook', '$rtakh', $Cipi, " .
		     "$phonlen, '$phon_true')";
		$query = mysqli_query($conn, $q);		
		if(!$query) {
			$error = true;
			$string .= "<p class='line'><a class='link' " .
				   "href='/poet:$poet_id'>$rtakh</a>" .
				   " › <a class='link' href='" .
				   "/poet:$poet_id/book:$book_id'>" .
				   "$rbook</a> › <a class='link' " .
				   "href='/poet:$poet_id/book:" .
				   "$book_id/poem:$poem_id'>$rname" .
				   "</a>: <b class='color-red'>" .
				   "نەء!</b></p>";
		}
	}

	mysqli_close($conn);

	/* Print error messages */
	echo "<p class='line'>ئەژماری شاعیران: " .
	     num_convert($aths_num, "en", "ckb") .
	     "</p><p class='line'>ئەژماری کتێبەکان: " .
	     num_convert($bks_num, "en", "ckb") .
	     "</p><p class='line'>ئەژماری شیعرەکان: " .
	     num_convert($pms_num, "en", "ckb") .
	     "</p>";
	echo $string;
	if(!$error) {
		echo "<p class='line' style='text-align:center'>" .
		     "<b class='color-blue'>جێ بە جێیە.</b></p>";
	}
	
	/* Update "last-update.txt" */
	if(!$error) {
		file_put_contents("../../../last-update.txt",
				  date("Y-m-d H:i:s"));
	}
	?>
</div>
<?php
require_once("../footer.php");
?>
