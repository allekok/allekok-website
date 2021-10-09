<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › شاعیران";
$desc = "شاعیران";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<style>
 input {
	 font-size:1.1em;
	 margin-bottom:1rem;
 }
 table {
	 margin:auto;
	 width:100%;
	 max-width:800px;
 }
 td {
	 border:0;
	 padding:.5em;
 }
 img {
	 display:block;
	 width:100%;
	 max-width:50px;
	 margin:auto;
 }
 .profile {
	 padding:.1em;
 }
 .profile img {
	 vertical-align:middle;
	 border-radius:50%;
 }
</style>
<div id="poets" style="font-size:.55em;text-align:right">
	<h1 style="font-size:2em" class="color-blue">
		شاعیران
	</h1>
	<input type="text"
	       id="filter-txt"
	       style="width:100%"
	       placeholder="گەڕان لە شاعیران‌دا...">
	<?php
	$q = "SELECT id, takh FROM auth ORDER BY takh";
	require_once("../condb.php");

	$columns = [
		["وێنە",
		 "10%"],
		["ژمارە",
		 "10%"],
		["ناسناو",
		 "60%"],
		["کاروبار",
		 "20%"],
	];

	echo "<table>";

	echo "<tr>";
	foreach($columns as $c) {
		echo "<th style='width:$c[1]' class='color-blue'>" .
		     $c[0] . 
		     "</th>";
	}
	echo "</tr>";
	
	while($res = mysqli_fetch_assoc($query)) {
		echo "<tr>";

		/* Image */
		$imgsrc = get_poet_image($res["id"], true);
		echo "<td class='profile border-bottom-eee'>" .
		     "<img src='$imgsrc'>" .
		     "</td>";

		/* Data */
		foreach($res as $r) {
			echo "<td class='border-bottom-eee'>" .
			     num_convert($r, "en", "ckb") .
			     "</td>";
		}
		
		/* Operations */
		echo "<td class='border-bottom-eee'>" .
		     "<a class='link material-icons' " .
		     "href='گۆڕینی شاعیر.php?id={$res['id']}'>edit</a>" .
		     "</td>";
		
		echo "</tr>";
	}

	echo "</table>";
	mysqli_close($conn);
	?>
</div>
<script>
 const filterTxt = document.getElementById("filter-txt")
 filterTxt.addEventListener("keyup", () => {
	 const context = document.querySelectorAll("table tr")
	 filterp(filterTxt.value, context)
 })
</script>
<?php
require_once("../footer.php");
?>
