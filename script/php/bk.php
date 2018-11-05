<div id="poets">

<img src="<?php echo get_poet_image($info['id'], 'profile', true); ?>" style="display: block;margin: auto;border-radius: 100%;max-width:120px;box-shadow: 0 3px 4px -3px #aaa;" alt="<?php echo $info['profname']; ?>"><?php 
$bbk = explode("/", $bknow[$bk-1]);

$bbk = !$bbk[1] ? $bbk[0] : "{$bbk[0]}<i style='color: {$colors[$ath][3]};font-size: .9em;padding: 0 .1em;'> / </i>{$bbk[1]}";

?>

<div id='adrs'>
<a href="/poet:<?php echo $ath; ?>">
<?php

echo $info['takh'];
?>
</a>
<i style='font-style:normal'> &rsaquo; </i>
<div id="current-location">
<?php
    $bknowdesc = explode(',',$info['bksdesc']);
    // echo $bknow[$bk-1].$bpgtit;
    echo $bbk;
    
    $bknowcomp = explode(',',$info['bks_completion']);
    if($bknowcomp[$bk-1] == 100) {
        
        echo("<i class='material-icons bk-comp' title='تەواوی ئەو کتێبە لە سەر ئاڵەکۆک، نووسراوەتەوە'>check</i>");
    
        echo("<span class='tt' id='bk-comp-tt'>تەواوی ئەو کتێبە لە سەر ئاڵەکۆک، نووسراوەتەوە</span>");
    }
?>
</div>

</div>
<?php
if(! empty($bknowdesc[$bk-1])) {
?>
<span id="bkondesc" style="display:block"><?php echo $bknowdesc[$bk-1]; ?></span>
<?php
}
?>

<form style='text-align:right;margin: .8em .5em .8em;' action="" method="post">
    <input type="hidden" style="display:none;" name="order" value="asc">
    <button type='submit' style="cursor:pointer;padding: 1em .8em;" class='button'><i class='material-icons'>sort_by_alpha</i> بەڕیز کردنی شێعرەکان لە ئا ڕا</button>
    <a id="new_poem_a" style="background:<?php echo $colors[$color_num][0]; ?>;color:<?php echo $colors[$color_num][1]; ?>;display: inline-block;float: left;font-size: 1.15em;padding: .5em .3em;" class="material-icons button" title="نووسینی شێعرێکی تازە" href="/pitew/index.php?poet=<?php echo $info['takh'] ; ?>&book=<?php echo $bknow[$bk-1]; ?>"><i class="material-icons" style="font-size: inherit;height: 0;vertical-align: top;">note_add</i></a>
</form>

<div id="sp">
<?php
while($row = mysqli_fetch_assoc($query)) {
$rid_k = num_convert($row['id'],"en","ckb");
    
?>
<a href="/poet:<?php echo $ath; ?>/book:<?php echo $bk; ?>/poem:<?php echo $row['id']; ?>">
<?php
echo($rid_k . ". " . $row['name']);
?>
</a>
<?php
}
?>
</div>
<script>
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
</script>

</div>
