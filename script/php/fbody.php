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
<div id='main' style="text-align:center">
    <?php if(isset($_GET['new'])) { ?>
        <p style="font-size:.6em;text-align:right">
	    مەبەست لە شاعیرانی نوێ، ئەو شاعیرانەن کە لە ژیان دا ماون.
        </p>
    <?php
    }
    if($query)
    {
	while($row=mysqli_fetch_assoc($query))
	{
	    $imgsrc = get_poet_image($row['id'],true);
	    echo '<a class="poet" href="/poet:'.$row['id'].'"
><img alt="'.$row['profname'].'" src="'.$imgsrc.'"
><h3 title="'.$row['profname'].'"
>'.$row['takh'].'</h3></a>';
	}
    }
    mysqli_close($conn);
    ?>
</div>
