<?php
/*
 * Input: REQUEST[poet, k]
 * Output: JSON
 */
require_once("../../script/php/functions.php");

header("Content-type:application/json; charset=UTF-8");

$null = json_encode(null);

$pt = isset($_REQUEST["poet"]) ?
      filter_var($_REQUEST["poet"], FILTER_SANITIZE_STRING) :
      die($null);
$k = isset($_REQUEST["k"]) ?
     filter_var($_REQUEST["k"], FILTER_SANITIZE_STRING) :
     FALSE;

if(empty($pt))
	die($null);

if($k) {
	if($k == "alive")
		$kind = "kind='alive'";
	elseif($k == "dead")
		$kind = "kind='dead'";
	elseif($k == "bayt")
		$kind = "kind='bayt'";
	else
		$kind = "1";
} else {
	$kind = "1";
}

echo get_poet_to_json(get_poet());

function get_poet() {
	global $kind, $pt;
	$poets = explode(",", $pt);
	$reses = [];

	foreach($poets as $pt) {
		if($pt == "all") {
			$q = "SELECT * FROM auth WHERE {$kind} ORDER BY takh";
		} elseif(filter_var($pt, FILTER_VALIDATE_INT)) {
			$q = "SELECT * FROM auth WHERE id={$pt}";
		} else {
			$q = "SELECT * FROM auth WHERE name='$pt' or " .
			     "takh='$pt' or profname='$pt'";
		}
		require_once("../../script/php/condb.php");
		if($query) {
			while($r = mysqli_fetch_assoc($query)) {
				unset($r["ord"]);
				$r["hdesc"] = str_replace(
					"[t]", " : ", $r["hdesc"]);
				$r["hdesc"]= explode("[n]", $r["hdesc"]);
				$r["bks"] = explode(",", $r["bks"]);
				$r["bksdesc"] = explode(",", $r["bksdesc"]);
				$r["bks_completion"] = explode(
					",", $r["bks_completion"]);
				$r["img"]["_130x130"] = _SITE . get_poet_image(
					$r["id"], FALSE);
				$r["img"]["_460x460"] = _SITE . get_poet_image(
					$r["id"], FALSE);
				$r["id"] = intval($r["id"]);
				$r["colors"] = ["#15c314", "#000",
						"#eee", "#444"];
				$reses[] = $r;
			}
		}
		mysqli_close($conn);
		if($pt == "all")
			break;
	}
	if($reses)
		return $reses;
}

function get_poet_to_json($get_poet) {
	return json_encode($get_poet);
}
?>
