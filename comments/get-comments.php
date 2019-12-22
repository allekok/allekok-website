<?php

// output: json
header("Content-Type: application/json; charset=UTF-8");

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/functions.php");

// number of comments
$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) ?
     $_GET["n"] : 20;

// query for non-blocked comments
$q = "select * from comments where blocked=0 order by id DESC LIMIT 0, {$n}";
include(ABSPATH . "script/php/condb.php");

if($query) {

    if(mysqli_num_rows($query)<1)
	die(json_encode(["err"=>1]));
    
    $comms = []; // comments
    while($res = mysqli_fetch_assoc($query)) {
        
        if(trim($res["name"]) == "")
	    $res["name"] = "ناشناس";
        
        $res["pt"] = substr($res['address'],strlen("poet:"),strpos($res['address'], "/")-strlen("poet:")); // poet's id from address(poet:{$pt}/...)
        $res["comment"] = str_replace("\n", "<br>\n", $res["comment"]); // replace newlines with <br>
        $res["date"] = explode(" ", $res["date"]); // split date string by space
        $res["date"] = $res["date"][0] . " " . $res["date"][1];
        $res["date"] = num_convert($res["date"], "en", "ckb");
        $res["date"] = str_replace(["am","pm"], [" بەیانی "," پاش‌نیوەڕۆ "], $res["date"]); // replace am,pm with kurdish ones.

	// unset unnecessary elements.
        unset($res["read"]);
        unset($res["blocked"]);
        
        $comms[] = $res;
    }
    
    foreach($comms as $b => $r) {
	// $b -> array key
	// $r -> element
        $r["naddress"] = explode("/", $r["address"]); // split address by slash("/")
        for($a = 0; $a < count($r['naddress']); $a++) {
            
            $r["naddress"][$a] = explode(":", $r["naddress"][$a]);
	    // split "naddress" elements by ":"
	    // 0=>["poet", poet's_id], ...
            
        }

	// query poet's takh per each comment
        $q = "select takh from auth where id={$r["naddress"][0][1]}";
        $query = mysqli_query($conn, $q);

	// poet's name
        $r["ptn"] = mysqli_fetch_assoc($query)["takh"];
	
	// query poem's name per each comment
        $q = "select name from tbl{$r["naddress"][0][1]}_{$r["naddress"][1][1]} where id={$r["naddress"][2][1]}";
        $query = mysqli_query($conn, $q);

	//poem's name
        $r["pmn"] = mysqli_fetch_assoc($query)["name"];

	// remove temp item "naddress"
        unset($r["naddress"]);
	
	// replace new comments by old ones
        $comms[$b] = $r;
    }

    // print the result
    echo json_encode($comms);
}

mysqli_close($conn);
?>
