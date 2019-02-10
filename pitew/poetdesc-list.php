<?php

include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; نووسینی زانیاری سەبارەت بە شاعیران &raquo; زانیاریەکان";
$desc = "ئەو زانیاریانەی کە بۆتان نووسیوین";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');

?>

<div id="poets">
    
    <div id='adrs'>
	<a href="first.php">
	    <i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<a href="edit-poet.php">
	    <i style='vertical-align:middle;' class='material-icons'>person</i>
	    نووسینی زانیاری سەبارەت بە شاعیران
	</a>
	<i style='font-style:normal;'> &rsaquo; </i>
	<div id="current-location">
	    زانیاریەکان
	</div>

    </div>

    <?php
    
    $_name = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
    $_poet = filter_var($_GET['poet'], FILTER_SANITIZE_STRING);
    ?>
    
    <style>
     .epld {
         padding: 1em;
         font-size: .6em;
         text-align: right;
         border-bottom: 2px dashed #e9e9e9;
     }
     .epld-title {
         padding: 0 1em;
         border-right: 5px solid #666;
         color: #000;
         font-size: 1em;
         font-weight: bold;
     }
     .epld-body {
         padding: 1em;
         border-right: 5px solid #eee;
         text-align: justify;
         color:#222;
     }
     #num_pdl {
         color: #444;
         font-size: .55em;
         display: inline-block;
         background: #f3f3f3;
         padding: .5em 1em;
     }
     .epld-expand {
	 font-size:1em;
	 padding:.5em;
     }
    </style>
    <script>
     function expand(item) {
	 var parent = item.parentNode.parentNode.querySelector(".epld-body");
	 if(parent.style.overflow != "hidden") {
	     parent.style.overflow = "hidden";
	     parent.style.maxHeight = "200px";
	     item.innerHTML = "زیاتر <i class='material-icons'>keyboard_arrow_down</i>";
	 } else {
	     parent.style.overflow = "";
	     parent.style.maxHeight = "";
	     item.innerHTML = "<i class='material-icons'>keyboard_arrow_up</i>";	     
	 }
     }
    </script>
    
    <div>
	
	<?php
	
	$_list = make_list(ABSPATH."pitew/res/");
	$_count = 0; $_html = "";
	if(!empty($_list)) {
            foreach($_list as $_l) {
		if(! empty($_name) and $_name !== $_l['name'])  continue;
		if(! empty($_poet) and $_poet !== $_l['poet']) {
                    $_count++;
                    continue;
		}
		$_html .= "<div class='epld'><section class='epld-title'><a href='/pitew/res/{$_l["filename"]}' title='وەشانی plain/text'><i class='material-icons' style='font-size: 1.5em;vertical-align: middle;'>insert_drive_file</i></a> &laquo;" . num_convert(str_replace("&#34;","\"",$_l['name']),"en","ckb") . "&raquo; سەبارەت بە &laquo;" . $_l['poet'] . "&raquo; نووسیویەتی: </section><section class='epld-body'";
		if(empty($_name) or empty($_poet)) $_html .= " style='overflow:hidden;max-height:150px;'";
		$_html .= ">{$_l['content']}</section>";
		if(empty($_name) or empty($_poet)) $_html .= "<div style='text-align:left;'><button class='epld-expand button' onclick='expand(this)'>زیاتر <i class='material-icons'>keyboard_arrow_down</i></button></div></div>";
		$_count++;
            }
	} else {
            echo "<span style='color:#999;font-size:1em;display:block'>&bull;</span>";
	}
	
	if(!($_name and $_poet)) {
            $n_str = empty($_name) ? "" : "ی &laquo;$_name&raquo;";
            echo "<div id='num_pdl'>ئەژماری نووسراوەکان" . num_convert(str_replace("&#34;","\"",$n_str), "en", "ckb") . ": " . num_convert($_count, "en", "ckb") . "</div>";
	}

	function make_list($path) {
	    $not = [".",".."];
	    $d = opendir($path);
	    $list = [];

	    while( false !== ($e_name = readdir($d)) ) {
		if(in_array($e_name , $not)) continue;

		$exp_e_name = explode("_",
				      str_replace([".txt"],
						  "",$e_name));
		
		$content = file_get_contents($path . $e_name);
		$content = substr($content,0,strlen($content)-4);
		$content = str_replace(["\nend\n","\n"],["<div style='border-top:1px solid #ddd;margin:1em;'></div>","<br>"],$content);
		$content = trim($content);
		
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
	
	<div style='text-align:right;margin:.3em 0'>
            <?php if($_name) { ?>
		<a class='button' href="/pitew/poetdesc-list.php">
		    تەواوی ئەو زانیاریانەی نووسراون
		</a>
            <?php } ?>
	</div>
	
	<div>
            <?php
            if(empty($_html)) {
                echo "<span style='color:#999;font-size:1em;display:block'>&bull;</span>";
            } else {
                echo $_html;
            }
            ?>
	</div>
	
    </div>
</div>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
