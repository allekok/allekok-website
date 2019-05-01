<?php
/* index.php body */
$__isnew = isset($_GET["new"]) ?
	   " WHERE kind='alive'" : " WHERE kind='dead'";

$__order = (isset($_GET["order"]) and $_GET["order"]=="id") ?
	   " ORDER BY id ASC" : " ORDER BY takh ASC";

$q = "SELECT id,profname,takh FROM auth" . $__isnew . $__order ;
require("condb.php");
?>

<div id='poets'>
    <div>
	<h2 style="padding:.5em 0;font-size:.65em">
	    <?php echo _DESC; ?>
	</h2>
        <?php if(isset($_GET['new'])) { ?>
            <span style="display: block;font-size: .55em;color: #444;padding: 1em;background-color: #f9f9f9;">
		مەبەست لە شاعیرانی نوێ، ئەو شاعیرانەن کە لە ژیان دا ماون.
            </span>
        <?php } ?>
	<?php
	
	if($query) {
	    while($row=mysqli_fetch_assoc($query)) {
		$imgsrc = get_poet_image($row['id'], "profile", 1);
		echo "<section class=\"psec\"><a href=\"/poet:{$row['id']}\"><img alt=\"{$row['profname']}\" src=\"{$imgsrc}\"><h3 title=\"{$row['profname']}\">{$row['takh']}</h3></a></section>";
	    }
	}
	mysqli_close($conn);
	?>
	
    </div><div style="padding: .5em 0 0;">
        <?php if(isset($_GET['new'])) { ?>
            <a class='button' style='display: inline-block;margin: 0 0 0 1em;padding:.5em .8em' href="/">شاعیرانی کۆچ‌کردوو</a><?php } else { ?><a class='button' style='display: inline-block;margin: 0 0 0 1em;padding:.5em .8em' href="/?new">شاعیرانی نوێ</a><?php } ?><a class='button' style='display: inline-block;margin: 0 1em 0 0;padding:.5em .8em' href="/poet:73">بەیتی کوردی</a>
    </div>

</div>
