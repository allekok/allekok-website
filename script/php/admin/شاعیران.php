<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; شاعیران";
$desc = "شاعیران";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>

<style>
 input {
	 font-size:.6em;
 }
 table {
	 margin:auto;
	 width:100%;
	 max-width:800px;
	 font-size:.6em;
	 text-align:right
 }
 
 img {
	 width:100%;
	 max-width:100px
 }
 #toolbox a {
	 color:#fff;
	 background:#444;
	 text-decoration:none;
	 display:block;
	 padding:.5em 0;
	 text-align:center;
	 font-size:.7em;
 }
 a:hover {
	 opacity:.7;
 }
 td {
	 border:0;
	 padding:.5em;
 }
 .profile {
	 padding:.1em;
 }
 .profile img {
	 vertical-align:middle;
	 border-radius:50%
 }
</style>
<div id="poets">	
	<input style="width:100%" type="text" id="filter-txt"
	       placeholder="گەڕان لە شاعیران‌دا...">
	<?php
	$q = "select id, profname from auth order by takh";
	require(ABSPATH."script/php/condb.php");
	
	$_ths = array(
		array("وێنە",
		      "7%"),
		array("ژمارە",
		      "5%"),
		array("ناسناو",
		      "55%"),
		array("کاروبار",
		      "10%")
	);
	
	echo "<table>";
	echo "<tr>";
	
	foreach($_ths as $_th) {
		
		echo "<th style='width:{$_th[1]}'>";
		echo $_th[0];
		echo "</th>";
	}
	
	echo "</tr>";
	
	while($res = mysqli_fetch_assoc($query)) {
		
		echo "<tr>";
		
		//poet img
		echo "<td class='profile border-bottom-eee'>";
		$_imgsrc = get_poet_image($res['id'],true);
		echo "<img src='$_imgsrc'>";
		echo "</td>";
		
		foreach($res as $_r) {
			echo "<td class='border-bottom-eee'>";
			echo num_convert($_r,"en","ckb");
			echo "</td>";
		}
		
		//operations
		echo "<td class='border-bottom-eee'>";
		echo "<a class='link material-icons' href='گۆڕینی شاعیر.php?id={$res['id']}'>edit</a>";
		echo "</td>";
		
		echo "</tr>";
	}
	
	echo "</table>";
	
	mysqli_close($conn);
	
	?>
</div>

<script>
 const filterTxt = document.getElementById("filter-txt");
 filterTxt.addEventListener("keyup", () => {
	 const context = document.querySelectorAll("table tr");
	 filterp(filterTxt.value, context);
 });
</script>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
