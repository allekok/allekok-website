<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

/* Delete */
$job = @filter_var($_GET['job'], FILTER_SANITIZE_STRING);
$nm = @filter_var($_GET['nm'], FILTER_SANITIZE_STRING);
$pt = @filter_var($_GET['pt'], FILTER_SANITIZE_STRING);

if(strtolower($job) == 'delete' and $nm and $pt)
{
	$f_name = "{$nm}_{$pt}.txt";
	$f_path = ABSPATH . "pitew/res/$f_name";
	if(file_exists($f_path))
	{
		unlink($f_path);
		list_dir(ABSPATH . 'pitew/res');
		header('Content-type:text/plain; Charset=utf-8');
		die('ok');
	}
}
/* Delete */

$title = $_TITLE . " &rsaquo; نووسینی زانیاری سەبارەت بە شاعیران";
$desc = "نووسینی زانیاری سەبارەت بە شاعیران";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<style>
 #poets p
 {
	 text-align:right;
	 font-size:.6em
 }
 #poets a
 {
	 font-size:1.3em;
	 padding:0 .5em;
 }
 #poets h1
 {
	 font-size:1em;
	 text-align:right;
 }
 #poets small
 {
	 display:block;
	 text-align:right;
	 font-size:.6em;
	 border-bottom:1px solid;
	 margin-bottom:1em;
 }
</style>
<div id="poets">
	<h1 class="color-blue">
		نووسینی زانیاری سەبارەت بە شاعیران
	</h1>
	<?php
	function make_list($_dir)
	{
		if(!is_dir($_dir)) return [];
		$d = opendir($_dir);
		$not = [".","..","README.md","list.txt"];
		$_list = [];
		while(false !== ($entry = readdir($d)))
		{
			if(in_array($entry,$not)) continue;
			$uri = "$_dir/$entry";
			$entry = str_replace([".jpeg",".jpg",".png",".txt"], "", $entry);
			$entry = explode("_", $entry);
			$entry["poet"] = $entry[0];
			$entry["name"] = $entry[1];
			array_unshift($entry, filemtime($uri));
			$_list[] = $entry;
		}
		@closedir($_dir);
		rsort($_list);
		return $_list;
	}

	$list = make_list(ABSPATH . 'pitew/res');
	// Print Count //
	echo "<small>ئەژمار: " . num_convert(count($list),'en','ckb') . "</small>";
	// Print Count //
	foreach($list as $i=>$item)
	{
		$pt = $item['name'];
		$nm = $item['poet'];
		$pt_ckb = num_convert($pt, 'en', 'ckb');
		$nm_ckb = num_convert($nm, 'en', 'ckb');
		echo '<p><i>' . num_convert($i+1, 'en', 'ckb') . '. ';
		echo "$nm_ckb :: $pt_ckb</i>
<a href='/pitew/poetdesc-list.php?name=$nm&poet=$pt'
class='material-icons'>search</a><a 
href='?job=delete&pt=$pt&nm=$nm'
class='material-icons a-delete' data='$nm_ckb :: $pt_ckb'
>delete</a></p>";
	}
	?>
	<script>
	 document.querySelectorAll('.a-delete').
		  forEach(function(o)
			  {
				  o.addEventListener('click', function(e)
					  {
						  e.preventDefault();
						  if(confirm('"' + o.getAttribute('data') + '" پاک بکرێتەوە؟'))
						  {
							  o.innerText = 'more_horiz';
							  getUrl(o.href, function (res)
								  {
									  if(res == 'ok')
									  {
										  const check = o.parentNode.querySelector('a');
										  check.classList.add('material-icons');
										  check.innerText = 'check';
										  o.remove();
									  }
							  });
						  }
				  });
		  });
	</script>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
