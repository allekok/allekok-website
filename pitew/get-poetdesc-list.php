<?php
require_once("../script/php/constants.php");
require_once(ABSPATH . "script/php/functions.php");

$n = @filter_var($_GET["n"], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET["n"] : 10;
$_name = isset($_GET['name']) ?
	 filter_var($_GET['name'], FILTER_SANITIZE_STRING) : '';
$_poet = isset($_GET['poet']) ?
	 filter_var($_GET['poet'], FILTER_SANITIZE_STRING) : '';
$_list = make_list(ABSPATH."pitew/res/");
$_count = 0;
$_html = "";
?>
<div id="poetdesc-list-main">
	<?php
	if($_list)
	{
		foreach($_list as $_l) {
			if($_name and ($_name != $_l['name'])) continue;
			if($_poet and ($_poet != $_l['poet']))
			{
				$_count++;
				continue;
			}
			$_encoded_name = urlencode($_l['name']);
			$_html .= "<div class='epld'
><section class='epld-title'><a target='_blank'
href='"._R."pitew/res/{$_l["filename"]}' 
title='وەشانی plain/text'><i 
class='material-icons' style='font-size:1.5em'
>insert_drive_file</i></a> &laquo;<a 
href='"._R."pitew/poetdesc-list.php?name=$_encoded_name'
>" . num_convert($_l['name'],"en","ckb") . "</a
>&raquo; سەبارەت بە &laquo;" .
				  $_l['poet'] .
				  "&raquo; نووسیویەتی: </section
><section class='epld-body'";
			$_html .= " style='overflow:hidden;
max-height:150px'";
			$_html .= ">{$_l['content']}</section>";
			$_html .= "<div style='text-align:left'
><button class='epld-expand' 
data-uri='"._R."pitew/res/{$_l['filename']}'
>زیاتر <i class='material-icons'>keyboard_arrow_down</i
></button></div></div>";
			$_count++;
		}
	}
	if(!($_name and $_poet))
	{
		$n_str = empty($_name) ?
			 "" : "ی &laquo;$_name&raquo;";
		echo "<div id='num_pdl'
>ئەژماری نووسراوەکان" . num_convert(
	str_replace("&#34;",'"',$n_str),
	"en", "ckb") . ": " .
		     num_convert($_count,
				 "en", "ckb") .
		     "</div>";
	}
	?>
	<div style='text-align:right;
		    margin:.3em 0;
		    font-size:.65em;
		    padding:.5em'>
		<?php if($_name) { ?>
			<a class='link' 
			   href="<?php echo _R; ?>pitew/poetdesc-list.php">
				&lsaquo; تەواوی ئەو زانیاریانەی نووسراون
			</a>
		<?php } ?>
	</div>
	<?php
	if(empty($_html))
		echo "<span style='font-size:1em;display:block'>&bull;</span>";
	else
		echo $_html;
	?>
</div>
<?php
function make_list($path) 
{
	global $n;
	$not = [".","..","README.md","list.txt"];
	$chunk = 250;
	$d = file_exists($path) ?
	     opendir($path) : die();
	$list = [];

	while(false !== ($e_name = readdir($d))) 
	{
		if(in_array($e_name , $not)) continue;
		if($n-- == 0) break;

		$exp_e_name = explode("_",
				      str_replace([".txt"],
						  "",$e_name));
		$f = fopen($path.$e_name,'r');
		$_chunk = trim(fread($f, 2 * $chunk));
		
		$content = mb_substr($_chunk, 0, $chunk) .
			   '...';
		fclose($f);
		$content = str_replace(
			["\nend\n", "\nend", "\n\n\n", "\n\n", "\n"],
			["<div style='
	      border-top:2px solid;margin:1em'
  ></div>", "<div style='
	      border-top:2px solid;margin:1em'
  ></div>", "؛ ", "؛ ", "؛ "], $content);

		$e = [
			"filemtime"=>filemtime($path.$e_name),
			"filename"=>$e_name,
			"name"=>$exp_e_name[0],
			"poet"=>$exp_e_name[1],
			"content"=>$content,
		];
		$list[] = $e;
	}

	rsort($list);
	return $list;
}
?>
