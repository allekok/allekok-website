<?php
/*
 * Input: REQUEST[poet, book, poem]
 * Output: Text, Header[x-con-len]
 */
require_once("../../script/php/functions.php");

header("Content-type:text/plain; charset=UTF-8");

$pt = isset($_REQUEST["poet"]) ?
      filter_var($_REQUEST["poet"], FILTER_SANITIZE_STRING) :
      die($null);
$bk = isset($_REQUEST["book"]) ?
      filter_var($_REQUEST["book"], FILTER_SANITIZE_STRING) :
      die($null);
$pm = isset($_REQUEST["poem"]) ?
      filter_var($_REQUEST["poem"], FILTER_SANITIZE_STRING) :
      die($null);

if(empty($pt) or empty($bk) or empty($pm))
	die($null);

$where = filter_var($pt, FILTER_VALIDATE_INT) ?
	 "id={$pt}" :
	 "takh='$pt' or profname='$pt' or name='$pt'";
$q = "SELECT * FROM auth WHERE {$where}";
require_once("../../script/php/condb.php");
if(!$query)
	die($null);

$poet = mysqli_fetch_assoc($query);
$poet["bks"] = explode(",", $poet["bks"]);

$pms = explode(",", $pm);
$poems = [];
foreach($pms as $pm) {
	if(!filter_var($bk, FILTER_VALIDATE_INT)) {
		$bk = array_search($bk, $poet["bks"]);
		if($bk === FALSE)
			die($null);
		$bk++;
	}
	elseif($bk > count($poet["bks"])) {
		die($null);
	}
	
	$_tbl = "tbl{$poet["id"]}_{$bk}";
	if($pm == "all") {
		$where = "";
	} else {
		$where = filter_var($pm, FILTER_VALIDATE_INT) ?
			 "WHERE id={$pm}" :
			 "WHERE name='$pm'";
	}
	$q = "SELECT * FROM {$_tbl} {$where} ORDER BY id";
	$query = mysqli_query($conn, $q);

	while($p = mysqli_fetch_assoc($query))
		$poems[] = $p;
}

mysqli_close($conn);

if(empty($poems))
	die($null);

$reses_str = "شاعیر: {$poet["takh"]}\n" .
	     "کتێب: {$poet["bks"][$bk-1]}\n";
foreach($poems as $k => $p) {
	$p["hon"] = str_replace(["\r", "&#39;", "&#34;", "&laquo;", "&raquo;"],
				["", "'", "\"", "«", "»"],
				$p["hon"]);
	$p["hon"] = preg_replace("/\n\n+/", "\n\n", $p["hon"]);
	$p["hon"] = trim(filter_var($p["hon"],
				    FILTER_SANITIZE_STRING));
	$reses_str .= "سەرناو: {$p["name"]}";
	$p["hdesc"] = str_replace("<br>", " - ", $p["hdesc"]);
	$p["hdesc"] = preg_replace("/\s\s+/u", " ", $p["hdesc"]);
	$p["hdesc"] = filter_var($p["hdesc"], FILTER_SANITIZE_STRING);
	$p["hdesc"] = trim(str_replace(["&#34;", "&#39;"],
				       ["\"", "'"],
				       $p["hdesc"]));
	if($p["hdesc"])
		$reses_str .= "\nسەبارەت: {$p["hdesc"]}";
	$reses_str .= "\n\n{$p["hon"]}\n\n++++++++++++++++++++++\n";
}

$content_length = mb_strlen($reses_str);
header("x-con-len:{$content_length}");
echo $reses_str;
?>
