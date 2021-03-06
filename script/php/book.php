<div id="poets">
	<!-- Poet picture -->
	<div style="position:relative;max-width:180px;
		    margin:auto">
		<img src="<?php 
			  echo _R . get_poet_image($info['id'],false);
			  ?>"
		     class="poet-pic-small"
		     alt="<?php echo $info['profname']; ?>"
		>
		<a href='<?php echo _R;
			 ?>pitew/poet-image.php?poet=<?php
						     echo $info['takh'];
						     ?>'
		   style="position:absolute;bottom:0;left:0;
			 padding:.5em .5em 0;font-size:.9em"
		   class="material-icons"
		   title="<?php P("ناردنی وێنە"); ?>">add_a_photo</a>
	</div><?php 
	      $bbk = explode("/", $bknow[$bk-1]);
	      $bbk = !isset($bbk[1]) ? $bbk[0] :
		     "{$bbk[0]}<i style='color:{$colors[0][3]};font-size: .9em;padding: 0 .1em;'> / </i>{$bbk[1]}";
	      ?>
	<!-- Address bar -->
	<div id='adrs'>
		<a href="<?php echo _R; ?>poet:<?php echo $ath; ?>">
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
			if(@$bknowcomp[$bk-1] == 100)
				echo "<i class='material-icons bk-comp' 
title='".SP("book-completed")."'>check</i>";
			?>
		</div>
		<?php
		if(@$bknowcomp[$bk-1] == 100)
			echo("<span class='tt' id='bk-comp-tt'
>".SP("book-completed")."</span>");
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
	<form action="" class="fontsize toolbar" method="post"
	      style="padding-bottom:1em;text-align:right">
		<input type="hidden"
		       style="display:none"
		       name="order" value="asc">
		<button type='submit'
			class="icon-round"
			style="padding:.2em .35em 0;
			      display:inline-block;
			      font-size:1.2em;margin-left:.2em"
		><i style="font-size:.9em"><?php P("ئا");
					   ?></i><i class="material-icons"
						 >arrow_downward</i></button>
		<a id="new_poem_a"
		   style="display:inline-block;
		       font-size:1.2em;
		       padding:.58em"
		   class="material-icons icon-round"
		   title="<?php P("نووسینی شیعرێکی تازە"); ?>"
		   href="<?php echo _R; 
			 ?>pitew/index.php?poet=<?php 
						echo $info['takh'].
						     "&book=".
						     $bknow[$bk-1];
						?>"
		>note_add</a>
		<a style="display:inline-block;
			  font-size:1.2em;
			  padding:.58em;"
		   class="material-icons icon-round"
		   target="_blank"
		   title="<?php P("داگرتنی ئەم کتێبە"); ?>"
		   href="<?php echo _R; 
			 ?>dev/tools/poem-plain.php?poet=<?php 
							 echo $info['id'].
							      "&book=$bk".
							      "&poem=all";
							 ?>"
		>cloud_download</a>		
	</form>
	<!-- List of poems -->
	<div id="sp">
		<?php
		while($row = mysqli_fetch_assoc($query))
		{
			$rid_k = num_convert($row['id'],'en','ckb');
		?>
			<div class="poem-item">
				<button class="material-icons"
					       style="font-size:1em;
					       padding:0 0 0 .5em"
					       type="button"
					       title="<?php P("poem-snippet"); ?>"
				>dehaze</button
				       ><a href="<?php 
						 echo _R . 'poet:'.$ath.
						      '/book:'.$bk.
						      '/poem:'.$row['id']; 
						 ?>">
					<?php
					echo($rid_k.'. '.$row['name']);
					?>
				       </a>
			</div>
		<?php
		}
		?>
	</div>
	<script>
	 /* Book completion icon click event */
	 const bk_comp = document.querySelector("#poets .bk-comp");
	 if(bk_comp !== null)
	 {
		 bk_comp.addEventListener("click", function() {
			 const tt = document.getElementById('bk-comp-tt');
			 if(tt.style.display === "block") 
				 tt.style.display = "none";
			 else 
				 tt.style.display = "block";
		 });
	 }
	 
	 document.querySelectorAll("#sp button").
		  forEach(function(b) {
			  b.addEventListener(
				  "click", function () {
					  show_summary_poem(b);
			  });
		  });
	</script>
</div>
