<?php
/*
 * Input: GET[ver, pt]
 * Output: Text[true | ""]
 */
header("Content-type: text/plain; charset=UTF-8");

$ver = isset($_GET["ver"]) ? $_GET["ver"] : die();
$pt = isset($_GET["pt"]) ? $_GET["pt"] : die();

$f = fopen("update-log.txt", "r") or die();

while(!feof($f)) {
	if($l = fgets($f)) {
		$l = json_decode($l);
		if($l->ver > $ver and $l->poetID == $pt) {
			echo "true";
			break;
		}
	}
}

fclose($f);
?>
