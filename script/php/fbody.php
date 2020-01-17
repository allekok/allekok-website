<?php
/* index.php body */
require_once('constants.php');

$__isnew = isset($_GET["new"]) ?
	   " WHERE kind='alive'" : " WHERE kind='dead'";

$__order = @$_GET["order"]=="id" ?
	   " ORDER BY id ASC" : " ORDER BY takh ASC";

$q = "SELECT id,profname,takh FROM auth" . $__isnew . $__order;
require(ABSPATH.'script/php/condb.php');
?>
<div id='poets'>
    <?php if(isset($_GET['new'])) { ?>
        <p style="font-size:.6em;text-align:right">
	    <?php P("new poets desc"); ?>
        </p>
    <?php
    }
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
	if(isset($_GET['new']))
	    echo '<a href="' . _R . '">' . SP("dead poets") . '</a>';
	else
	    echo '<a href="' . _R . '?new">' . SP("new poets") . '</a>';
	
	echo '<a href="' . _R . 'poet:73">' . SP("beyt") . '</a>';
	?>
    </div>
</div>
