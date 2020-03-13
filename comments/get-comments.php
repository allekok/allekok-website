<?php
/*
 * Print out {n} comments from 'comments' table.
 * Input: GET(n)
 * Output: JSON
 */
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/functions.php");

header("Content-Type: application/json; charset=UTF-8");

/* Number of comments */
$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) ?
     $_GET["n"] : 20;
$LIMIT = $n == -1 ? "" : "LIMIT 0, $n";

/* Query for non-blocked comments */
$q = "select * from comments where blocked=0 order by id DESC $LIMIT";
include(ABSPATH . "script/php/condb.php");
if(!$query) die(json_encode(["err"=>1]));

$comms = []; // comments
while($res = mysqli_fetch_assoc($query))
{
    if(trim($res["name"]) == "")
	$res["name"] = "ناشناس";

    /* Poet's id from address(poet:{$pt}/...) */
    /* 5 = strlen("poet:") */
    $res["pt"] = substr($res['address'], 5, strpos($res['address'], "/") - 5);
    /* replace newline characters with <br> */
    $res["comment"] = str_replace("\n", "<br>\n", $res["comment"]);
    /* Split 'date' string by space */
    /* Don't change these two lines; thats for legacy support.
       In the earlier versions user's IP address also would be
       saved in the 'date' field. */
    $res["date"] = explode(" ", $res["date"]);
    $res["date"] = $res["date"][0] . " " . $res["date"][1];
    $res["date"] = num_convert($res["date"], "en", "ckb");
    $res["date"] = str_replace(["am","pm"], [" بەیانی "," پاش‌نیوەڕۆ "], $res["date"]); 

    /* Unset unnecessary fields */
    unset($res["read"]);
    unset($res["blocked"]);
    
    $comms[] = $res;
}

/* Fetch Poet's name, Poem title for each comment. */
foreach($comms as $key => $comm)
{
    /* Split address by slashes ('/') */
    $_adrs = explode("/", $comm["address"]);
    $_adrs_len = count($_adrs);
    for($i = 0; $i < $_adrs_len; $i++)
    {
	/* split [$_adrs] elements by ":"
	   [ [0] => ["poet", "poet's id"], ... ] */
        $_adrs[$i] = explode(":", $_adrs[$i]);
    }

    /* Poet's name */
    $q = "select takh from auth where id={$_adrs[0][1]}";
    $query = mysqli_query($conn, $q);
    $comm["ptn"] = @mysqli_fetch_assoc($query)["takh"];
    
    /* Poem title */
    $tbl = "tbl{$_adrs[0][1]}_{$_adrs[1][1]}";
    $q = "select name from {$tbl} where id={$_adrs[2][1]}";
    $query = mysqli_query($conn, $q);
    $comm["pmn"] = @mysqli_fetch_assoc($query)["name"];

    /* Replace old comments by new ones */
    $comms[$key] = $comm;
}
mysqli_close($conn);

/* Print the result */
echo json_encode($comms);
?>
