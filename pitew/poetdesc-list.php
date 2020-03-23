<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; پتەوکردنی ئاڵەکۆک &rsaquo;
 نووسینی زانیاری سەبارەت بە شاعیران &rsaquo; زانیاریەکان";
$desc = "ئەو زانیاریانەی کە لەسەر ئاڵەکۆک‌تان نووسیوە";
$keys = $_KEYS;
$t_desc = "";

$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET["n"] : -1;
$_name = isset($_GET['name']) ?
	 filter_var($_GET['name'], FILTER_SANITIZE_STRING) : '';
$_poet = isset($_GET['poet']) ?
	 filter_var($_GET['poet'], FILTER_SANITIZE_STRING) : '';

include(ABSPATH . 'script/php/header.php');
?>
<style>
 #poetdesc-list-main .epld {
     padding: 1em;
     font-size: .6em;
     text-align: right;
 }
 #poetdesc-list-main .epld-title {
     padding: 0 1em;
     border-right: 2px solid;
     font-size: 1.05em;
 }
 #poetdesc-list-main .epld-body {
     padding:1em;
     text-align:justify;
     word-wrap:break-word;
 }
 #poetdesc-list-main #num_pdl {
     font-size: .55em;
     display: inline-block;
     padding: .5em 1em;
 }
 #poetdesc-list-main .epld-expand {
     font-size:1.1em;
     padding:.5em;
 }
 #poetdesc-list-main .epld-expand .material-icons {
     font-size:1.1em;
 }
</style>
<div id="poets">    
    <div id='adrs'>
	<a href="first.php">
	    پتەوکردنی ئاڵەکۆک
	</a>
	<i> &rsaquo; </i>
	<a href="edit-poet.php">
	    <i class='material-icons'>person</i>
	    نووسینی زانیاری سەبارەت بە شاعیران
	</a>
	<i> &rsaquo; </i>
	<div id="current-location">
	    زانیاریەکان
	</div>
    </div>    
    <div id="result"></div>
</div>
<script>
 function loadPoetdescList (poet, name, n) {
     const result = document.getElementById("result");
     result.innerHTML = "<div class='loader'></div>";
     getUrl(`get-poetdesc-list.php?poet=${poet}&name=${name}&n=${n}`,
	    function (resp) {
		result.innerHTML = resp;
		ajax();
		document.querySelectorAll('.epld-expand').forEach(function (o)
		    {
			o.onclick = function ()
			{
			    expand(o, o.getAttribute('data-uri'));
			}
		});
     });
 }
 <?php if(!$no_head) { ?>
 window.addEventListener("load", function () {
 <?php } ?>
     loadPoetdescList("<?php echo $_poet; ?>",
		      "<?php echo $_name; ?>",
		      "<?php echo $n; ?>");
     <?php if(!$no_head) { ?>
 });
     <?php } ?>
 function expand (item,path)
 {
     const parent = item.parentNode.parentNode.
			 querySelector(".epld-body"),
	   from = [/\nend\n/g,
		   /\nend/g,
		   /\n/g,],
	   to = ["<div style='border-top:2px solid;margin:1em'></div>",
		 "<div style='border-top:2px solid;margin:1em'></div>",
		 "<br>"];
     
     if(parent.style.overflow != "hidden")
     {
	 parent.style.overflow = "hidden";
	 parent.style.maxHeight = "150px";
	 item.innerHTML = "زیاتر <i \
class='material-icons'>keyboard_arrow_down</i>";
     }
     else
     {
	 item.innerHTML = "<div class='loader'></div>";
	 if(path)
	 {
	     getUrl(path,function(responseText)
		 {
		     responseText = responseText.trim();
		     for(const i in from)
		     {
			 responseText =
			     responseText.replace(from[i], to[i]);
		     }
		     parent.innerHTML = responseText;
		     parent.style.overflow = "";
		     parent.style.maxHeight = "";
		     item.innerHTML = "<i \
class='material-icons'>keyboard_arrow_up</i>";
	     });
	 }
	 else
	 {
	     parent.style.overflow = "";
	     parent.style.maxHeight = "";
	     item.innerHTML = "<i \
class='material-icons'>keyboard_arrow_up</i>";
	 }
     }
 }
</script>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
