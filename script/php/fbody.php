<?php

$__isnew = isset($_GET['new']) ? " WHERE kind='alive'" : " WHERE kind='dead'";

$db = 'index';

$__order = " ORDER BY takh ASC";
    
$q = "SELECT id,profname,takh FROM auth" . $__isnew . $__order ;
require('condb.php');

?>

<script>
    document.querySelector("#tS").style.display="none";
    document.querySelector("#search").style.display="block";
    document.querySelector("#search").style.marginTop=".3em";
</script>

<div id='poets' style='max-width:1200px;padding-top:unset;'>
    <div style="padding:.3em .5em .5em; text-align:right;">
        <?php if(isset($_GET['new'])) { ?>
        <a class='button' style='padding:0.7em 1em;display:inline-block' href="<?php echo _SITE; ?>">شاعیرانی کۆچ‌کردوو</a>
        <?php } else { ?>
        <a class='button' style='padding:0.7em 1em;display:inline-block' href="<?php echo _SITE; ?>?new">شاعیرانی نوێ</a>
        <?php } ?>
        
        <a class='button' style='padding:0.7em 1em;display:inline-block' href="<?php echo _SITE; ?>poet:73">بەیتی کوردی</a>
        <?php if(isset($_GET['new'])) { ?>
        <span style="display: block;font-size: 0.6em;color: #444;padding: 1em 1em 0;">
          مەبەست لە شاعیرانی نوێ، ئەو شاعیرانەن کە هێشتا لە ژیان ماون.
        </span>
        <?php } ?>
    </div><div style="animation:tL .25s ease-in;">
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
</div>

</div>