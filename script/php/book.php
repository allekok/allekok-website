<div id="poets">
    <!-- Poet picture -->
    <img src="<?php 
	      echo get_poet_image($info['id'],true); 
	      ?>"
	 class="poet-pic-small"
	 alt="<?php echo $info['profname']; ?>"
    ><?php 
     $bbk = explode("/", $bknow[$bk-1]);
     $bbk = !isset($bbk[1]) ? $bbk[0] :
	    "{$bbk[0]}<i style='color:{$colors[$color_num][3]};font-size: .9em;padding: 0 .1em;'> / </i>{$bbk[1]}";
     ?>
    <!-- Address bar -->
    <div id='adrs'>
	<a href="/poet:<?php echo $ath; ?>">
	    <?php
	    echo $info['takh'];
	    ?>
	</a>
	<i> &rsaquo; </i>
	<div id="current-location">
	    <?php
	    echo $bbk;
	    $bknowdesc = explode(',',$info['bksdesc']);	    
	    $bknowcomp = explode(',',$info['bks_completion']);
	    if($bknowcomp[$bk-1] == 100)
		echo "<i class='material-icons bk-comp' 
title='تەواوی ئەو کتێبە لە سەر ئاڵەکۆک، نووسراوەتەوە'>check</i>";
	    ?>
	</div>
	<?php
	if($bknowcomp[$bk-1] == 100)
	    echo("<span class='tt' id='bk-comp-tt'
>تەواوی ئەو کتێبە لە سەر ئاڵەکۆک، نووسراوەتەوە</span>");
	?>
    </div>
    <?php
    if(!empty($bknowdesc[$bk-1])) {
    ?>
	<span id="bkondesc"
	      style="display:block"
	><?php echo $bknowdesc[$bk-1]; ?></span>
    <?php
    }
    ?>
    <!-- Toolbar -->
    <form class="border-bottom-eee"
	  style='text-align:right;
		 margin:.2em;
		 display:flex;'
	  action="" method="post">
	<input type="hidden"
	       style="display:none"
	       name="order" value="asc">
	<div style="width:100%"
	><button type='submit'
		 style="cursor:pointer;
		       padding:1em 0;
		       display:block;
		       font-size:.65em"
		 class='button'
	 ><i class="icon-round" style="padding:.1em .7em 0"
	  >ئا</i> بەڕیز کردنی شێعرەکان لە ئا ڕا</button></div>
	<a id="new_poem_a"
	   style="color:
	       <?php 
	       echo $colors[$color_num][0].';';
	       ?>
	       display:inline-block;
	       font-size:1.35em;
	       padding:.4em .3em"
	   class="material-icons button"
	   title="نووسینی شێعرێکی تازە"
	   href="/pitew/index.php?poet=<?php 
				       echo $info['takh'].
					    "&book=".
					    $bknow[$bk-1];
				       ?>"
	>note_add</a>
    </form>
    <!-- List of poems -->
    <div id="sp">
	<?php
	while($row = mysqli_fetch_assoc($query))
	{
	    $rid_k = num_convert($row['id'],
				 "en","ckb");
	?>
	    <div style="display:flex;">
		<button class="material-icons button"
			style="font-size:1em;
			       padding:0 .5em"
			type="button"
			title="نیشان‌دانی بەشی سەرەتای ئەم شێعرە"
		>keyboard_arrow_down</button
				    ><a href="<?php 
					      echo "/poet:".
						   $ath.
						   "/book:".
						   $bk.
						   "/poem:".
						   $row['id']; 
					      ?>">
		    <?php
		    echo($rid_k.". ".$row['name']);
		    ?>
		</a>
	    </div>
	<?php
	}
	?>
    </div>
    <script>
     /* Book completion icon click event */
     var bk_comp = document.querySelector(".bk-comp");
     if(bk_comp !== null) {
	 bk_comp.addEventListener("click", function() {
	     var tt = document.getElementById('bk-comp-tt');
	     if(tt !== null) {
		 if(tt.style.display === "block") {
		     tt.style.display = "none";
		 } else {
		     tt.style.display = "block";
		 }
	     }
	 });
     }

     function show_summary(button) {
	 var href = button.parentNode.
			   querySelector("a").
			   getAttribute("href");
	 href = href.split("/");
	 button.innerHTML = "<div class='loader' \
style='width:2.2em;height:2.2em'></div>";
	 var pt = href[1].split(":")[1],
	     bk = href[2].split(":")[1],
	     pm = href[3].split(":")[1];
	 
	 var xmlhttp = new XMLHttpRequest();
	 xmlhttp.open("GET",
		      "/script/php/poem-summary.php?pt="+
		      pt+"&bk="+bk+"&pm="+pm);
	 xmlhttp.onload = function() {
             button.innerHTML = "keyboard_arrow_down";
             var san_txt = this.responseText.
				replace(/\n/g, "<br>");
             button.parentNode.outerHTML += "<div class='back-f3f3f3' \
style='padding:1em;font-size:.55em;'\
>"+san_txt+"</div>";
	 }
	 xmlhttp.send();
     }
     
     document.querySelectorAll("#sp button").
	      forEach(function(e) {
		  e.addEventListener(
		      "click", function () {
			  show_summary(e);
		      });
	      });
    </script>
</div>
