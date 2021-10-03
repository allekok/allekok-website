<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › گۆڕینی کتێبەکان بۆ گەڕان";
$desc = "گۆڕینی کتێبەکان بۆ گەڕان";
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
		گۆڕینی کتێبەکان بۆ گەڕان
	</h1>
	<?php
	/* Read */
	$q = "SELECT * FROM auth ORDER BY takh ASC";
	require_once("../condb.php");
	
	$aths_num = mysqli_num_rows($query);
	$bks_num = 0;
	$aths = [];
	
	while($res = mysqli_fetch_assoc($query)) {
		$res["bks"] = explode(",", $res["bks"]);
		$res["bksdesc"] = explode(",", $res["bksdesc"]);
		$bks_num += count($res["bks"]);
		$aths[] = $res;
	}
	
	/* Write */
	$string = "<p class='line'>ئەژماری شاعیران: " .
		  num_convert($aths_num, "en", "ckb") .
		  "</p><p class='line'>ئەژماری کتێبەکان: " .
		  num_convert($bks_num, "en", "ckb") .
		  "</p>";
	$error = false;
	mysqli_select_db($conn, _SEARCH_DB);
	mysqli_query($conn, "TRUNCATE TABLE books");
	
	foreach($aths as $ath) {
		$poet_id = $ath["id"];
		$rtakh = $ath["takh"];
		for($i = 0; $i < count($ath["bks"]); $i++) {
			$book_id = $i + 1;
			$rbook = $ath["bks"][$i];
			$book = san_data($ath["bks"][$i]);
			$book_desc = @san_data($ath["bksdesc"][$i]);
			$len = strlen($book) > strlen($book_desc) ?
			       strlen($book) :
			       strlen($book_desc);
			
			$query = mysqli_query(
				$conn,
				"INSERT INTO `books`(`book`," .
				" `book_desc`, `poet_id`," .
				" `book_id`, `rtakh`, `rbook`," .
				" `len`) VALUES ('$book'," .
				" '$book_desc', '$poet_id'," .
				" '$book_id', '$rtakh', '$rbook'," .
				" '$len')");
			if(!$query) {
				$error = true;
				$string .= "<p class='line'>" .
					   "<a class='link' " .
					   "href='/poet:$poet_id'>" .
					   "$rtakh</a> › " .
					   "<a class='link' " .
					   "href='/poet:$poet_id/" .
					   "book:$book_id'>" .
					   "$rbook</a>: <b class=" .
					   "'color-red'>نەء!</b></p>";
			}
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
