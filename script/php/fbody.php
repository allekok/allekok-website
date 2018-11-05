<?php

$__isnew = isset($_GET['new']) ? " WHERE kind='alive'" : " WHERE kind='dead'";

$db = 'index';

$__order = " ORDER BY takh ASC";
    
$q = "SELECT id,profname,takh FROM auth" . $__isnew . $__order ;
require('condb.php');

?>

<script>
window.onload = function() {
    document.querySelector("#tS").style.display="none";
    document.querySelector("#search").style.display="block";
    document.querySelector("#search").style.marginTop=".3em";
}
</script>

<div id='poets' style='padding-top:unset;'>
    <div style="animation:tL .8s;padding:1em 0 1em;">
        <?php if(isset($_GET['new'])) { ?>
        <span style="display: block;font-size: .55em;color: #444;padding: 1em;background-color: #f3f3f3;margin-top: 1em;">
          مەبەست لە شاعیرانی نوێ، ئەو شاعیرانەن کە لە ژیان دا ماون.
        </span>
        <?php } ?>
<?php
    
if($query) {

while($row=mysqli_fetch_assoc($query)) {

    $imgsrc = get_poet_image($row['id'], "profile", 1);
?>
<section class="psec"><a href="/poet:<?php echo $row['id'] ?>"><img alt="<?php echo $row['profname']; ?>" src="<?php echo $imgsrc; ?>"><h3><?php  echo $row['takh'];  ?></h3></a></section><?php
}

}
mysqli_close($conn);

?>
</div><div style="padding: 1em 0 0;border-top: 1px solid #eee;background:linear-gradient(to bottom, #f8f8f8, #fdfdfd);">
        <?php if(isset($_GET['new'])) { ?>
        <a style='display: inline-block;font-size: .6em;color: #555;margin: 0 0 0 1em;background:#f2f2f2;padding:1em;' href="/">شاعیرانی کۆچ‌کردوو</a><?php } else { ?><a style='display: inline-block;font-size: .6em;color: #555;margin: 0 0 0 1em;background:#f2f2f2;padding:1em;' href="/?new">شاعیرانی نوێ</a><?php } ?><a style='display: inline-block;font-size: .6em;color: #555;margin: 0 1em 0 0;background:#f2f2f2;padding:1em;' href="/poet:73">بەیتی کوردی</a>
    </div>


</div>