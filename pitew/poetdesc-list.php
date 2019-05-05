<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo;
 نووسینی زانیاری سەبارەت بە شاعیران &raquo; زانیاریەکان";
$desc = "ئەو زانیاریانەی کە لەسەر ئاڵەکۆک‌تان نووسیوە";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');
?>
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
    <?php
    $_name = filter_var(@$_GET['name'],
			FILTER_SANITIZE_STRING);
    $_poet = filter_var(@$_GET['poet'],
			FILTER_SANITIZE_STRING);
    ?>
    
    <style>
     .epld:nth-child(even) {
	 background:#f9f9f9;
     }
     .epld {
         padding: 1em;
         font-size: .6em;
         text-align: right;
     }
     .epld-title {
         padding: 0 1em;
         border-right: 5px solid #666;
         color: #222;
         font-size: 1.05em;
     }
     .epld-body {
         padding:1em;
         text-align:justify;
         color:#000;
	 word-wrap:break-word;
     }
     #num_pdl {
         color: #222;
         font-size: .55em;
         display: inline-block;
         background: #f9f9f9;
         padding: .5em 1em;
     }
     .epld-expand {
	 font-size:1.1em;
	 padding:.5em 1.5em .5em .5em;
     }
     .epld-expand .material-icons {
	 font-size:1.1em;
     }
    </style>
    <script>
     function expand(item,path) {
	 var parent = item.parentNode.
			   parentNode.
			   querySelector(".epld-body"),
	     from = [/\nend\n/g,/\nend/g,/\n/g,],
	     to = ["<div style='border-top:1px solid #ddd;margin:1em'></div>","<div style='border-top:1px solid #ddd;margin:1em'></div>","<br>"];
	 
	 if(parent.style.overflow != "hidden") {
	     parent.style.overflow = "hidden";
	     parent.style.maxHeight = "150px";
	     item.innerHTML = "زیاتر <i \
class='material-icons'>keyboard_arrow_down</i>";
	 } else {
	     item.innerHTML = "<div class='loader' \
style='width:2em;height:2em'></div>";
	     if(path) {
		 getUrl(path,function(responseText) {
		     responseText = responseText.trim();
		     for(var i in from) {
			 responseText =
			     responseText.replace(from[i],
						  to[i]);
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
    
    <div>
	<?php
	$_list = make_list(ABSPATH."pitew/res/");
	$_count = 0; $_html = "";
	if(!empty($_list))
	{
            foreach($_list as $_l) {
		if(!empty($_name)
		    and $_name !== $_l['name']) continue;
		if(!empty($_poet)
		    and $_poet !== $_l['poet']) {
                    $_count++;
                    continue;
		}
		$_encoded_name = urlencode($_l['name']);
		$_html .= "<div class='epld'
><section class='epld-title'><a 
href='/pitew/res/{$_l["filename"]}' 
title='وەشانی plain/text'><i 
class='material-icons' style='font-size:1.5em'
>insert_drive_file</i></a> &laquo;<a 
href='/pitew/poetdesc-list.php?name=$_encoded_name'
>" . num_convert($_l['name'],"en","ckb") . "</a
>&raquo; سەبارەت بە &laquo;" .
			  $_l['poet'] .
			  "&raquo; نووسیویەتی: </section
><section class='epld-body'";
		$_html .= " style='overflow:hidden;
max-height:150px'";
		$_html .= ">{$_l['content']}</section>";
		$_html .= "<div style='text-align:left'
><button class='epld-expand button' 
onclick='expand(this,\"/pitew/res/{$_l["filename"]}\")'
>زیاتر <i class='material-icons'>keyboard_arrow_down</i
></button></div></div>";
		$_count++;
            }
	}
	else
	{
            echo "<span style='color:#999;
font-size:1em;display:block'>&bull;</span>";
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

	function make_list($path) {
	    $not = [".","..","README.md","list.txt"];
	    $chunk = 4 * 100;
	    $d = file_exists($path) ?
		 opendir($path) : die();
	    $list = [];
	    
	    while(false !== ($e_name = readdir($d))) {
		if(in_array($e_name , $not)) continue;

		$exp_e_name = explode("_",
				      str_replace([".txt"],
						  "",$e_name));
		$f = fopen($path.$e_name,'r');
		$content = ltrim(fread($f, $chunk)) .
			   '...';
		fclose($f);
		$content = str_replace(
		    ["\nend\n","\n"],
		    ["<div style='
border-top:1px solid #ddd;margin:1em'
></div>","<br>"], $content);
		
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
	
	<div style='text-align:right;
		    margin:.3em 0;
		    font-size:.65em;
		    padding:.5em'>
            <?php if($_name) { ?>
		<a class='link' 
		   href="/pitew/poetdesc-list.php">
		    &lsaquo; تەواوی ئەو زانیاریانەی نووسراون
		</a>
            <?php } ?>
	</div>
	<div>
            <?php
            if(empty($_html))
                echo "<span style='color:#999;
font-size:1em;display:block'>&bull;</span>";
            else 
                echo $_html;
            ?>
	</div>
    </div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
