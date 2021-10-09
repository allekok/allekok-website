<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › گەڕانەکان";
$desc = "گەڕانەکان";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<div id="poets">
	<h1 style="text-align:right;font-size:1.1em"
	    class="color-blue">
		گەڕانەکان
	</h1>
	<?php
	$c = (isset($_REQUEST["c"]) &&
	      filter_var($_REQUEST["c"], FILTER_VALIDATE_INT)) ?
	     intval($_REQUEST["c"]) :
	     0;
	$n = (isset($_REQUEST["n"]) &&
	      filter_var($_REQUEST["n"], FILTER_VALIDATE_INT)) ?
	     intval($_REQUEST["n"]) :
	     25;

	$db = _SEARCH_DB;
	$q = "SELECT Cipi, rtakh, rbook, rname, " .
	     "poet_id, book_id, poem_id, id FROM poems " .
	     "WHERE Cipi > {$c} ORDER BY Cipi DESC LIMIT 0, {$n}";
	require_once("../condb.php");
	
	$columns = [
		["کرتە",
		 "5%"],
		["شیعر",
		 "90%"],
		["ژمارە",
		 "5%"],
	];
	echo "<table style='font-size:.6em'>";
	echo "<tr>";
	foreach($columns as $column) {
		echo "<th class='color-blue' " .
		     "style='width:{$column[1]}'>" .
		     $column[0] .
		     "</th>";
	}
	echo "</tr>";
	
	while($res = mysqli_fetch_assoc($query)) {
		echo "<tr style='text-align:right'>" .
		     "<td>" .
		     num_convert($res["Cipi"], "en", "ckb") .
		     "</td>";
		
		$adrs = "poet:" . $res["poet_id"] .
			"/book:" . $res["book_id"] .
			"/poem:" . $res["poem_id"];
		echo "<td>" .
		     "<a href='/$adrs'>" .
		     $res["rtakh"] . " › " .
		     $res["rbook"] . " › " .
		     $res["rname"] . "</a>" .
		     "</td>";
		
		echo "<td>" .
		     num_convert($res["id"], "en", "ckb") .
		     "</td>" .
		     "</tr>";
	}
	
	echo "</table>";
	mysqli_close($conn);
	?>
</div>
<?php
require_once("../footer.php");
?>
