<?php
/* index.php body */
require_once('constants.php');

$__order = @$_GET["order"]=="id" ?
	   " ORDER BY id ASC" : " ORDER BY takh ASC";

$q = "SELECT id,profname,takh FROM auth WHERE kind != 'bayt'" . $__order;
require(ABSPATH.'script/php/condb.php');
?>
<div id='poets'>
	<?php
	if($query)
	{
		while($row=mysqli_fetch_assoc($query))
		{
			$imgsrc = _R . get_poet_image($row['id'],false);
			echo '<a class="poet" href="' . _R . 'poet:'.$row['id'].'"
><img alt="'.$row['profname'].'" src="'.$imgsrc.'"
><h3 title="'.$row['profname'].'"
>'.$row['takh'].'</h3></a>';
		}
	}
	mysqli_close($conn);
	?>
	<div class='fbody-nav'>
		<?php 
		echo '<a href="' . _R . 'poet:73">' . SP("beyt") . '</a>';
		?>
	</div>
</div>
