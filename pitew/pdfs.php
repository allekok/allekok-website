<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; داگرتنی دیوانی شاعیران";
$desc = "داگرتنی دیوانی شاعیران بە فۆڕمەتی PDF";
$keys = $_KEYS;
$t_desc = "";

$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET["n"] : -1;

include(ABSPATH . "script/php/header.php");
?>
<style>
 #pdfs-main .eee {
	 text-align:right;
	 font-size:.55em;
	 padding:.2em 1em;
 }
 #pdfs-main .eee-nfo {
	 font-size:.65em;
	 font-family:monospace;
 }
 #pdfs-main .eee span {
	 font-size:.85em;
 }
 #pdfs-main .eee-desc {
	 font-size:.85em;
	 padding:0 1em 0 0;
	 margin-right:1em;
	 display:none;
 }
 #pdfs-main .eee .material-icons {
	 font-size: 1.5em;
	 margin-right: .2em;
	 cursor:pointer;
 }
 #pdfs-main .eee .material-icons:hover {
	 color:<?php echo $_colors[2]; ?>;
 }
 #pdfs-search #filter-txt {
	 width: 100%;
	 font-size: .65em;
	 margin:.5em 0;
 }
</style>
<div id="poets">
	<h1 class="color-blue" style="text-align:right;font-size:1em">
		داگرتنی دیوانی شاعیران
	</h1>
	
	<div id="pdfs-search">
		<input type="text" id="filter-txt"
		       placeholder="گەڕان لە کتێبەکان‌دا...">
	</div>
	
	<main id="pdfs-main"></main>
	<script>
	 let context;
	 function loadPdfs (n) {
		 const result = document.getElementById("pdfs-main");
		 result.innerHTML = "<div class='loader'></div>";
		 getUrl(`get-pdfs.php?n=${n}`, function (resp) {
			 result.innerHTML = resp;
			 document.querySelectorAll('#pdfs-main .pdfs-roll').forEach(function (o) {
				 o.onclick = function () {roll(o)}
			 });
			 context = document.getElementById("pdfs-main").
					    querySelectorAll(".eee");
		 });
	 }
	 <?php if(! $no_head) { ?>
	 window.addEventListener("load", function () {
	 <?php } ?>
		 loadPdfs("<?php echo $n; ?>");
		 <?php if(! $no_head) { ?>
	 });
		 <?php } ?>
	 
	 function roll(obj)
	 {
		 const desc = obj.parentNode.querySelector(".eee-desc");
		 if(desc.style.display == "block")
		 {
			 desc.style.display = "none";
			 obj.innerHTML = "info_outline";
		 }
		 else
		 {
			 desc.style.display = "block";
			 obj.innerHTML = "keyboard_arrow_up";
		 }
	 }

	 const needle = document.querySelector("#pdfs-search #filter-txt");
	 function _filter()
	 {
		 setTimeout(() => {
			 filterp(needle.value, context);
		 }, 100);
	 }
	 needle.onkeyup = _filter;
	</script>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
