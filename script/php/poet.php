<div id="poets">
    <!-- Poet picture -->
    <div style="position:relative;max-width:180px;
		margin:auto">
	<img src="<?php 
		  echo get_poet_image($ath,true); 
		  ?>"
	     class="poet-pic-small"
	     alt="<?php echo $row['profname']; ?>"
	>
	<a href='/pitew/poet-image.php?poet=<?php
					    echo $row['takh'];
					    ?>'
	   style="position:absolute;bottom:0;left:0;
		 padding:.2em;font-size:.9em;
		 opacity:.7"
	   class="material-icons button"
	   title="ناردنی وێنە">add_a_photo</a>
    </div>
    <!-- Address bar -->
    <div id='adrs'>
	<div id="current-location">
	    <?php
	    echo $row["profname"];
	    ?>
	</div>
    </div>
    <!-- Poet books -->
    <div class='bks'>
	<p><?php
	   if($row['kind'] != "bayt")
	       echo "بەرهەمەکان: ";
	   else
	       echo "بەیتەکان: ";
	   ?></p>
	<?php
	$rbks = explode(',',$row['bks']);
	for($i=0;$i<count($rbks);$i++) {
	    echo "<a href='/poet:" . $row['id'] .
		 "/book:" . ($i+1) .
		 "'>" . num_convert($i+1,"en","ckb") .
		 ". " . $rbks[$i] . "</a>";
	}
	?>
    </div>
    <!-- Poet information -->
    <div class="poetdesc">	    
	<?php
	if($row['kind'] != "bayt") {
	    echo "<p>سەبارەت: </p>";
	    if(strlen($row['hdesc'])>0) {
		$_hd = explode("[n]",$row['hdesc']);
		foreach($_hd as $__hd) {
		    $__hd = explode("[t]",$__hd);
		    echo "<h3 class='poetnm'>";
		    echo "<span style='color:#555'>";
		    echo $__hd[0];
		    echo "</span>";
		    echo " : ";
		    echo $__hd[1];
		    echo "</h3>";
		}
	    }
	    /* Poet pictures */
	    foreach(scandir(ABSPATH."style/img/poets/new")
		as $file)
	    {
		$file_poet = explode("_",$file)[0];
		if($file_poet == $row['takh'])
		{
		    echo "<h3 class='poetnm'><a class='link'
style='border-bottom:0;margin:0'
href='/pitew/image-list.php?poet={$row['takh']}'
><i class='material-icons'>photo_library</i> وێنەکان</a></h3>";
		    break;
		}
	    }
	    $edit_uri = "/pitew/edit-poet.php?poet={$row['takh']}";
	?>
	<div style="text-align:right;">
	    <a style="font-size:.8em;color:#444;
		      padding:1em;display:block"
	       href="<?php echo $edit_uri; ?>">
		زانیاری زیاترتان سەبارەت بە 
		&laquo;
		<?php echo $row['takh']; ?>
		&raquo;
		هەیە؟ دەتوانن لێرە کرتە بکەن و بینووسن.
	    </a>
	    <div>
		<!-- Infos written by users -->
		<?php
		$_uri = ABSPATH . "pitew/res/";
		if(file_exists($_uri)) {
		    $ignore = [".","..","README.md"];
		    $dir = opendir($_uri);
		    $result = [];
		    while(false !== ($pe = readdir($dir))) {
			if(in_array($pe,$ignore))
			    continue;
			$e = explode("_", str_replace(".txt","",$pe));
			if(@$e[1] == $row['takh']) {
			    $ef = fopen($_uri.$pe, "r");
			    $ef_ln = fgets($ef);
			    if(trim($ef_ln)) {
				$ef_ln = num_convert(
				    str_replace("&#34;","\"",$ef_ln),
				    "en", "ckb");
				$ef_ln = mb_substr($ef_ln,0,100);
			    }
			    fclose($ef);
			    $result[] = [$e, $ef_ln];
			}
		    }
		    closedir($dir);
		    
		    foreach($result as $n) {
			echo "<a class='link' style=\"font-size:.75em;
padding:.5em;display:block;border-radius:3px;margin:0\" 
href=\"/pitew/poetdesc-list.php?name={$n[0][0]}&poet={$n[0][1]}\"
><span style='display:block'>
&laquo;".num_convert(
		str_replace("&#34;","\"",$n[0][0]),"en","ckb")."&raquo;نووسیویەتی:
</span><span style='border-right:5px solid #999;padding-right:.5em;
font-size:.95em;display:block;white-space:nowrap;overflow:hidden;
text-overflow:ellipsis;margin-right:.5em;'>{$n[1]}...</span></a>";
		    }
		}
		?>
	    </div>
	</div>
    </div>
	<?php
	/* End of if($row['kind']!='bayt') */
	}
	?>
</div>
