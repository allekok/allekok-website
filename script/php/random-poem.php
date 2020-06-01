<?php
/* 
 * [Compute || Print || Redirect to] a random poem's url
 * Input: REQUEST[redirect, nohead, nofoot]
 * Output: text/plain || none -> Redirection
 */
require_once ("constants.php");
require_once (ABSPATH."script/php/functions.php");

$db = _SEARCH_DB;
$q = "select id from poems";
require(ABSPATH."script/php/condb.php");

$limit = mysqli_num_rows($query);
$random_id = mt_rand(1, $limit);

$q = "select poet_id, book_id, poem_id from poems where id=$random_id";
$query = mysqli_query($conn, $q);
if(!$query) die();

$res = mysqli_fetch_assoc($query);

$url = _R."poet:{$res["poet_id"]}/" .
       "book:{$res["book_id"]}/" .
       "poem:{$res["poem_id"]}";

if(isset($_random_poem_noprint));
elseif(isset($_REQUEST["redirect"])) {
	$red_url = _SITE."?ath={$res["poet_id"]}" .
		   "&bk={$res["book_id"]}" .
		   "&id={$res["poem_id"]}";
	if(isset($_REQUEST["nohead"])) $red_url .= "&nohead";
	if(isset($_REQUEST["nofoot"])) $red_url .= "&nofoot";
	redirect($red_url);
}
else {
	header("Content-type: text/plain");
	echo $url;
}
?>
