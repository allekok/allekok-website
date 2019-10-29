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
		 padding:.5em .5em 0;font-size:.9em"
	   class="material-icons"
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
    <div id="poet-info">
	<!-- Poet books -->
	<div class='bks'>
	    <p><?php
	       if($row['kind'] != "bayt")
		   echo "بەرهەمەکان";
	       else
		   echo "بەیتەکان";
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
	    echo "<p>سەبارەت</p>";
	    if(strlen($row['hdesc'])>0) {
		$_hd = explode("[n]",$row['hdesc']);
		foreach($_hd as $__hd) {
		    $__hd = explode("[t]",$__hd);
		    echo "<h3 class='poetnm'>";
		    echo "<span>";
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
		<a style="font-size:.8em;
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
			$ignore = [".","..","README.md","list.txt"];
			$dir = opendir($_uri);
			$result = [];
			while(false !== ($pe = readdir($dir))) {
			    if(in_array($pe,$ignore))
				continue;
			    $e = explode("_", str_replace(".txt","",$pe));
			    if(@$e[1] == $row['takh']) {
				$ef = fopen($_uri.$pe, "r");
				while(! feof($ef))
				{
				    if($ef_ln = trim(fgets($ef)))
				    {
					$ef_ln = num_convert(
					    str_replace("&#34;","\"",$ef_ln),
					    "en", "ckb");
					$ef_ln = mb_substr($ef_ln,0,100);
					break;
				    }
				}
				fclose($ef);
				$result[] = [$e, $ef_ln];
			    }
			}
			closedir($dir);
			
			foreach($result as $n) {
			    echo "<a style=\"font-size:.8em;
padding:.5em;display:block;margin:0\" 
href=\"/pitew/poetdesc-list.php?name={$n[0][0]}&poet={$n[0][1]}\"
><span style='display:block'>
&laquo;".num_convert(
		    str_replace("&#34;",'"',$n[0][0]),"en","ckb")."&raquo; نووسیویەتی:
</span><span style='padding-right:1em;
font-size:1em;display:block;white-space:nowrap;overflow:hidden;
text-overflow:ellipsis;border-right:2px solid'>{$n[1]}...</span></a>";
			}
		    }
		    ?>
		</div>
	    </div>
	</div>
    </div>
</div>
