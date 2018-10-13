<div id="poets">
<p id='adrs'>
    <?php
        $__allekok_url = ($info['kind'] == "dead" || $info['kind'] == "bayt") ? "/" : "/?new";
    ?>
<a href="<?php echo $__allekok_url; ?>" style='background-image:url(/style/img/allekok.png);background-repeat:no-repeat;background-position: 3.7em 0.1em;padding-right: 1.8em;background-size: 1.6em;'>ئاڵەکۆک</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>

<a href="/poet:<?php echo $ath; ?>">
<?php

echo "<i style='vertical-align:middle;' class='material-icons'>person</i>" . " " . $info['takh'];
?>
</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>
<?php

$bknowdesc = explode(',',$info['bksdesc']);
echo "<i style='vertical-align:middle;' class='material-icons'>book</i>" . " " . $bknow[$bk-1].$bpgtit;
?>
</p>

<h3 id="bkon">
<img src="<?php echo get_poet_image($info['id'], 'profile', true); ?>" style="display: block;margin: auto;border-radius: 100%;max-width:120px;box-shadow: 0 3px 4px -3px #aaa;" alt="<?php echo $info['profname']; ?>"><?php 
$bbk = explode("/", $bknow[$bk-1]);

$bbk = !$bbk[1] ? $bbk[0] : "<i style='font-style: normal;font-size: .8em;color: #444;'>{$bbk[0]}</i><i style='color: {$colors[$ath][3]};font-size: .9em;padding: 0 .1em;'>/</i>{$bbk[1]}";

echo $bbk; ?>
<?php
$bknowcomp = explode(',',$info['bks_completion']);
if($bknowcomp[$bk-1] == 100) {
    
    echo("<i class='material-icons bk-comp' title='تەواوی ئەو کتێبە لە سەر ئاڵەکۆک، نووسراوەتەوە'>check</i>");

    echo("<span class='tt' id='bk-comp-tt'>تەواوی ئەو کتێبە لە سەر ئاڵەکۆک، نووسراوەتەوە</span>");
}
?>
<span id="bkondesc" style="display:block"><?php echo $bknowdesc[$bk-1]; ?></span>
</h3>

<form style='text-align:right;margin: 0 .5em .8em;' action="" method="post">
    <input type="hidden" style="display:none;" name="order" value="asc">
    <button type='submit' style="cursor:pointer;padding: 1em .8em;" class='button'><i class='material-icons'>sort_by_alpha</i> بەڕیز کردنی شێعرەکان لە ئا ڕا</button>
    <a id="new_poem_a" style="display: inline-block;float: left;font-size: 1.15em;padding: .5em .3em;" class="material-icons button" title="نووسینی شێعرێکی تازە" href="/pitew/index.php?poet=<?php echo $info['takh'] ; ?>&book=<?php echo $bknow[$bk-1]; ?>"><i class="material-icons" style="font-size: inherit;height: 0;vertical-align: top;">note_add</i><span id="note_add_title" style="font-family: 'kurd';font-size: .5em;vertical-align: top;padding: .7em .7em 0;">نووسینی شێعری تازە</span></a>
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
